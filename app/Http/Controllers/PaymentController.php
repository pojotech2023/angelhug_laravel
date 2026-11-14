<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Login;
use App\Models\Order;
use App\Models\Course;
use Razorpay\Api\Api;
use Exception;

class PaymentController extends Controller
{
    private const TWOFACTOR_API_KEY = '190bf1ae-29d1-11f1-bcb0-0200cd936042';
    private const TEST_LOGIN_MOBILE = '9999999999';
    private const TEST_LOGIN_OTP = '1234';
    private const OTP_RESEND_COOLDOWN_SECONDS = 30;

    private function generateOtp(string $mobile): string
    {
        $isTestLogin = app()->environment(['local', 'staging']) || app()->isLocal();

        if ($isTestLogin && $mobile === self::TEST_LOGIN_MOBILE) {
            return self::TEST_LOGIN_OTP;
        }

        return (string) rand(1000, 9999);
    }

    private function sendOtpToMobile(string $mobile, string $otp): array
    {
        // Test login — skip real API call
        if ($mobile === self::TEST_LOGIN_MOBILE) {
            return ['success' => true, 'session_id' => null];
        }

        $apiKey = env('TWOFACTOR_API_KEY', self::TWOFACTOR_API_KEY);
        $url    = "https://2factor.in/API/V1/{$apiKey}/SMS/{$mobile}/AUTOGEN/OTP1";

        try {
            $response = Http::withoutVerifying()
                            ->timeout(15)
                            ->get($url);

            Log::info('2Factor OTP send response', [
                'mobile' => $mobile,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            $body = $response->json();

            if (isset($body['Status']) && $body['Status'] === 'Success') {
                return [
                    'success' => true,
                    'session_id' => $body['Details'] ?? null,
                ];
            }

            Log::warning('2Factor OTP send failed', [
                'mobile' => $mobile,
                'response' => $body,
            ]);

            return ['success' => false, 'session_id' => null];

        } catch (Exception $e) {
            Log::error('2Factor OTP send exception', [
                'mobile' => $mobile,
                'message' => $e->getMessage(),
            ]);

            return ['success' => false, 'session_id' => null];
        }
    }

    private function storeOtpSession(string $mobile, ?string $sessionId): void
    {
        Session::put('auth_mobile', $mobile);
        Session::put('otp_mobile', $mobile);
        Session::put('twofactor_sid', $sessionId);
        Session::put('otp_last_sent_at', now()->timestamp);
    }

    private function mergeCartItems(array $existingCart, array $sessionCart): array
    {
        $mergedCart = $existingCart;

        foreach ($sessionCart as $id => $item) {
            $mergedCart[$id] = $item;
        }

        return $mergedCart;
    }

    private function supportsPersistentCart(): bool
    {
        return Schema::hasColumn('users', 'cart');
    }

    private function createPendingOrder(string $razorpayOrderId, array $cart, float $total): Order
    {
        return Order::updateOrCreate(
            ['razorpay_order_id' => $razorpayOrderId],
            [
                'user_id' => Auth::id(),
                'razorpay_order_id' => $razorpayOrderId,
                'amount' => $total,
                'status' => 'pending',
                'items' => array_values($cart),
            ]
        );
    }

    private function storeCompletedOrder(string $razorpayOrderId, string $razorpayPaymentId, array $cart): void
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        Order::updateOrCreate(
            ['razorpay_order_id' => $razorpayOrderId],
            [
                'user_id' => Auth::id(),
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'amount' => $total,
                'status' => 'completed',
                'items' => array_values($cart),
            ]
        );

        Session::forget('cart');
        /** @var User|null $user */
        $user = Auth::user();
        if ($user instanceof User && $this->supportsPersistentCart()) {
            $user->cart = [];
            $user->save();
        }
    }

    private function completePendingOrder(string $razorpayOrderId, string $razorpayPaymentId): ?Order
    {
        $order = Order::where('razorpay_order_id', $razorpayOrderId)->first();

        if (!$order) {
            return null;
        }

        $order->update([
            'razorpay_payment_id' => $razorpayPaymentId,
            'status' => 'completed',
        ]);

        return $order;
    }

    // Login Form
    public function getLoginForm()
    {
        return view('customerlogin');
    }

    // Send OTP
    public function webLogin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile_no' => 'required|numeric|digits:10'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $name = $request->input('name');
        $email = $request->filled('email') ? $request->input('email') : null;
        $mobile = $request->mobile_no;
        $user = User::updateOrCreate(
            ['mobile_no' => $mobile],
            ['name' => $name, 'email' => $email]
        );

        Session::put('auth_name', $name);
        Session::put('auth_email', $email);

        $otp = $this->generateOtp($mobile);

        Login::updateOrCreate(
            ['mobile_no' => $mobile],
            ['otp' => $otp, 'name' => $name, 'email' => $email]
        );

        $otpResponse = $this->sendOtpToMobile($mobile, $otp);

        if ($otpResponse['success']) {
            $this->storeOtpSession($mobile, $otpResponse['session_id']);

            return redirect()->route('otp.page');
        } else {
            return back()->withErrors(['otp' => 'OTP sending failed.']);
        }
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $mobile = Session::get('auth_mobile');
        $sessionId = Session::get('twofactor_sid');

        if (!$mobile) {
            return redirect()->route('customer.login')->withErrors(['otp' => 'Session expired. Try again.']);
        }

        $isValidOtp = false;

        if ($mobile === self::TEST_LOGIN_MOBILE && $request->otp === self::TEST_LOGIN_OTP) {
            $isValidOtp = true;
        } elseif ($sessionId) {
            $apiKey = env('TWOFACTOR_API_KEY', self::TWOFACTOR_API_KEY);
            $url = "https://2factor.in/API/V1/{$apiKey}/SMS/VERIFY/{$sessionId}/{$request->otp}";
            $response = Http::withoutVerifying()
                            ->timeout(15)
                            ->get($url);

            $body = $response->json();
            $isValidOtp = isset($body['Status']) && $body['Status'] === 'Success';
        }

        if ($isValidOtp) {
            $user = User::updateOrCreate(
                ['mobile_no' => $mobile],
                [
                    'name' => Session::get('auth_name'),
                    'email' => Session::get('auth_email'),
                ]
            );

            $mergedCart = Session::get('cart', []);

            if ($this->supportsPersistentCart()) {
                $mergedCart = $this->mergeCartItems($user->cart ?? [], $mergedCart);
                $user->cart = $mergedCart;
                $user->save();
            }

            Auth::login($user);
            Session::put('cart', $mergedCart);
            
            Session::forget(['auth_mobile', 'otp_mobile', 'twofactor_sid', 'auth_name', 'auth_email', 'otp_last_sent_at']);
            
            // Check if user came from a specific page (e.g., booking service)
            $redirectTo = Session::get('redirect_after_login');
            Session::forget('redirect_after_login');
            
            if ($redirectTo) {
                if (str_starts_with($redirectTo, 'http://') || str_starts_with($redirectTo, 'https://') || str_starts_with($redirectTo, '/')) {
                    return redirect($redirectTo)->with('success', 'Logged in successfully! You may now proceed with your booking.');
                }
                if ($redirectTo === 'payment') {
                    return redirect()->route('payment.page');
                }
                if ($redirectTo === 'cart') {
                    return redirect()->route('cart');
                }
                if (\Illuminate\Support\Facades\Route::has($redirectTo)) {
                    return redirect()->route($redirectTo)->with('success', 'Logged in successfully!');
                }
            }
            
            // Workflow: After login, customer proceeds to book services
            return redirect()->route('service')->with('success', 'Logged in successfully! Please select a service to book.');
        } else {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }
    }

    public function resendOtp()
    {
        $mobile = Session::get('auth_mobile');

        if (!$mobile) {
            return redirect()->route('customer.login')->withErrors(['otp' => 'Session expired. Try again.']);
        }

        $lastSentAt = (int) Session::get('otp_last_sent_at', 0);
        $secondsSinceLastSend = now()->timestamp - $lastSentAt;

        if ($lastSentAt && $secondsSinceLastSend < self::OTP_RESEND_COOLDOWN_SECONDS) {
            $waitSeconds = self::OTP_RESEND_COOLDOWN_SECONDS - $secondsSinceLastSend;

            return back()->withErrors([
                'otp' => "Please wait {$waitSeconds} seconds before requesting a new OTP."
            ]);
        }

        $otp = $this->generateOtp($mobile);

        Login::updateOrCreate(
            ['mobile_no' => $mobile],
            [
                'otp' => $otp,
                'name' => Session::get('auth_name'),
                'email' => Session::get('auth_email'),
            ]
        );

        $otpResponse = $this->sendOtpToMobile($mobile, $otp);

        if (!$otpResponse['success']) {
            return back()->withErrors(['otp' => 'OTP sending failed.']);
        }

        $this->storeOtpSession($mobile, $otpResponse['session_id']);

        return back()->with('success', 'A new OTP has been sent to your mobile number.');
    }

    // Payment Page
    public function paymentPage()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            Session::put('redirect_after_login', 'payment');
            return redirect()->route('customer.login')->with('error', 'Please login first');
        }

        // Check if cart has items
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty');
        }

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('payment.payment', compact('total', 'cart'));
    }

    // Create Razorpay Order
    public function createOrder(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Your cart is empty.'], 422);
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        $orderData = [
            'receipt'         => 'order_' . time(),
            'amount'          => $request->amount * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        try {
            $order = $api->order->create($orderData);

            $this->createPendingOrder($order['id'], $cart, $request->amount);

            return response()->json([
                'order_id' => $order['id'],
                'amount' => $order['amount'],
                'currency' => $order['currency']
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Verify Payment
    public function verifyPayment(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $cart = Session::get('cart', []);
            $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

            if ($order) {
                if (empty($cart)) {
                    $this->completePendingOrder($request->razorpay_order_id, $request->razorpay_payment_id);
                } else {
                    $this->storeCompletedOrder($request->razorpay_order_id, $request->razorpay_payment_id, $cart);
                }
            } else {
                if (empty($cart)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cart is empty. Please add the item again before payment confirmation.',
                    ], 422);
                }

                $this->storeCompletedOrder($request->razorpay_order_id, $request->razorpay_payment_id, $cart);
            }
            
            return response()->json([
                'success' => true, 
                'message' => 'Payment successful',
                'redirect' => route('order.success')
            ]);
        } catch (Exception $e) {
            Log::error('Payment verification failed', [
                'user_id' => Auth::id(),
                'order_id' => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function paymentStatus($orderId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $existingOrder = Order::where('razorpay_order_id', $orderId)
            ->where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($existingOrder && $existingOrder->status === 'completed') {
            return response()->json([
                'success' => true,
                'status' => 'completed',
                'redirect' => route('order.success'),
            ]);
        }

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payments = $api->order->fetch($orderId)->payments();
            $paymentItems = $payments['items'] ?? [];

            foreach ($paymentItems as $payment) {
                if (($payment['status'] ?? null) === 'captured') {
                    if ($existingOrder) {
                        $this->completePendingOrder($orderId, $payment['id']);
                    } else {
                        $cart = Session::get('cart', []);
                        if (!empty($cart)) {
                            $this->storeCompletedOrder($orderId, $payment['id'], $cart);
                        }
                    }

                    return response()->json([
                        'success' => true,
                        'status' => 'completed',
                        'redirect' => route('order.success'),
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'status' => 'pending',
            ]);
        } catch (Exception $e) {
            Log::error('Payment status check failed', [
                'user_id' => Auth::id(),
                'order_id' => $orderId,
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    // Order Success Page
    public function orderSuccess()
    {
        return view('order-success');
    }

    // My Orders Page
    public function myOrders()
    {
        $this->reconcilePendingOrders();

        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->get();

        $orders->transform(function ($order) {
            $order->items = collect($order->items)->map(function ($item) {
                if (empty($item['pdf_file'])) {
                    $matchedCourse = null;

                    if (!empty($item['course_id'])) {
                        $matchedCourse = Course::find($item['course_id']);
                    }

                    if (!$matchedCourse && !empty($item['title']) && !empty($item['type'])) {
                        $matchedCourse = Course::where('title', $item['title'])
                            ->where('type', $item['type'])
                            ->first();
                    }

                    if (!$matchedCourse && !empty($item['title'])) {
                        $matchedCourse = Course::where('title', $item['title'])->first();
                    }

                    if ($matchedCourse) {
                        $item['pdf_file'] = $matchedCourse->pdf_file;
                    }
                }

                return $item;
            })->toArray();

            return $order;
        });

        return view('my-orders', compact('orders'));
    }

    private function reconcilePendingOrders(): void
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        Order::where('status', 'pending')
            ->whereNotNull('razorpay_order_id')
            ->whereNull('razorpay_payment_id')
            ->take(20)
            ->get()
            ->each(function ($order) use ($api) {
                try {
                    $payments = $api->order->fetch($order->razorpay_order_id)->payments();
                    foreach (($payments['items'] ?? []) as $payment) {
                        if (($payment['status'] ?? null) === 'captured') {
                            $order->update([
                                'razorpay_payment_id' => $payment['id'],
                                'status' => 'completed',
                            ]);
                            Log::info('Reconciled pending Razorpay order', [
                                'order_id' => $order->id,
                                'razorpay_order_id' => $order->razorpay_order_id,
                                'payment_id' => $payment['id'],
                            ]);
                            break;
                        }
                    }
                } catch (Exception $e) {
                    Log::warning('Failed to reconcile pending order', [
                        'order_id' => $order->id,
                        'razorpay_order_id' => $order->razorpay_order_id,
                        'message' => $e->getMessage(),
                    ]);
                }
            });
    }

    public function purchasedList()
    {
        $purchaseRows = collect();

        $this->reconcilePendingOrders();

        Order::with('user')
            ->where('status', 'completed')
            ->latest()
            ->get()
            ->each(function ($order) use ($purchaseRows) {
                $fallbackLogin = null;
                $customerName = $order->user->name ?? null;
                $customerEmail = $order->user->email ?? null;
                $customerMobile = $order->user->mobile_no ?? null;

                if (blank($customerName) && blank($customerEmail) && blank($customerMobile)) {
                    $fallbackLogin = Login::whereNotNull('name')
                        ->where('name', '<>', '')
                        ->whereNotNull('mobile_no')
                        ->where('mobile_no', '<>', '')
                        ->where('created_at', '<=', $order->created_at)
                        ->latest('created_at')
                        ->first();

                    $customerName = $fallbackLogin->name ?? null;
                    $customerEmail = $fallbackLogin->email ?? null;
                    $customerMobile = $fallbackLogin->mobile_no ?? null;
                }

                foreach (($order->items ?? []) as $item) {
                    $qty = (int) ($item['qty'] ?? 1);
                    $price = (float) ($item['price'] ?? 0);

                    $purchaseRows->push([
                        'customer_name' => $customerName ?: 'N/A',
                        'customer_email' => $customerEmail ?: 'N/A',
                        'mobile_no' => $customerMobile ?: 'N/A',
                        'item_type' => ucfirst($item['type'] ?? 'Course'),
                        'item_title' => $item['title'] ?? 'N/A',
                        'qty' => $qty,
                        'item_amount' => $price * $qty,
                        'order_amount' => (float) $order->amount,
                        'payment_id' => $order->razorpay_payment_id ?? 'N/A',
                        'status' => ucfirst($order->status ?? 'N/A'),
                        'purchased_at' => $order->created_at,
                    ]);
                }
            });

        $perPage = 20;
        $currentPage = request()->integer('page', 1);
        $currentItems = $purchaseRows->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $purchases = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $purchaseRows->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.purchased-list', compact('purchases'));
    }
}
