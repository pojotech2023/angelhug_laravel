<?php

use App\Models\ApplicationForm;
use App\Models\Banner;
use App\Models\Login;
use App\Models\Order;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\ServiceEnquiry;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\AdminBillingSettingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminWebsiteSettingController;
use App\Http\Controllers\ApplicationFormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Main Pages
Route::get('/', function () {
    $banners = Banner::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $services = Service::with('subServices')->where('is_active', true)->latest()->take(6)->get();
    return view('index', compact('banners', 'services'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/service', [ServiceController::class, 'serviceview'])->name('service');
Route::get('/service/{id}', [ServiceController::class, 'servicedetails'])->name('servicedetails');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/terms-and-conditions', function () {
    $brandName = \App\Models\Setting::get('brand_name', 'AngelHug');
    $terms = \App\Models\Setting::get('terms_and_conditions', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_TERMS);
    $cancellation = \App\Models\Setting::get('cancellation_policy', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_CANCELLATION);
    return view('terms_and_conditions', compact('brandName', 'terms', 'cancellation'));
})->name('terms.public');

Route::post('/contact-enquiry', [ContactController::class, 'store'])->name('contact.enquiry');

// Booking Flow (Date & Time, OTP, Razorpay)
Route::get('/booking/{service_id?}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/proceed', [BookingController::class, 'proceedToSummary'])->name('booking.proceed');
Route::get('/booking/summary/{booking_number}', [BookingController::class, 'appointmentSummary'])->name('booking.summary');
Route::post('/booking/send-otp', [BookingController::class, 'sendOtp'])->name('booking.send_otp');
Route::post('/booking/verify-otp', [BookingController::class, 'verifyOtp'])->name('booking.verify_otp');
Route::post('/booking/create-order', [BookingController::class, 'createRazorpayOrder'])->name('booking.create_order');
Route::post('/booking/verify-payment', [BookingController::class, 'verifyPayment'])->name('booking.verify_payment');
Route::post('/booking/confirm-cash', [BookingController::class, 'confirmCash'])->name('booking.confirm_cash');
Route::get('/booking/confirmation/{booking_number}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::get('/api/reverse-geocode', [BookingController::class, 'reverseGeocode'])->name('api.reverse_geocode');

// Service History (Customer)
Route::get('/service-history', [BookingController::class, 'history'])->name('service.history');

// Other public legacy pages
Route::get('/board_direct', function () {
    return view('board_direct');
})->name('board_direct');

Route::get('/list/{type}', [CourseController::class, 'frontentview'])->name('courses');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.details');

// Customer Login / OTP Routes
Route::get('/customer/login', [PaymentController::class, 'getLoginForm'])->name('customer.login');
Route::post('/customer/login', [PaymentController::class, 'webLogin'])->name('login.submit');
Route::get('/customer/otp', function() { return view('otp_verification'); })->name('otp.page');
Route::post('/customer/verify-otp', [PaymentController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/customer/resend-otp', [PaymentController::class, 'resendOtp'])->name('otp.resend');

// Caretaker / Healthcare Staff Public Application Form (Dedicated Separate URLs)
Route::get('/caretaker-form', [CaretakerController::class, 'create'])->name('caretaker.apply');
Route::get('/caretaker-registration', [CaretakerController::class, 'create'])->name('caretaker.register');
Route::get('/caretaker', [CaretakerController::class, 'create'])->name('caretaker.short');
Route::get('/join-as-caretaker', [CaretakerController::class, 'create']);
Route::get('/apply-caretaker', [CaretakerController::class, 'create']);
Route::post('/caretaker-form', [CaretakerController::class, 'store'])->name('caretaker.store');
Route::post('/caretaker-registration', [CaretakerController::class, 'store']);

// Cart Routes
Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('add.to.cart');
Route::post('/add-to-cart-ajax/{id}', [CartController::class, 'addAjax'])->name('cart.add.ajax');
Route::post('/cart/update/{id}', [CartController::class, 'updateQty'])->name('cart.update.qty');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Payment Routes (Requires Customer Login)
Route::middleware('auth')->group(function() {
    Route::get('/payment', [PaymentController::class, 'paymentPage'])->name('payment.page');
    Route::post('/create-order', [PaymentController::class, 'createOrder']);
    Route::post('/verify-payment', [PaymentController::class, 'verifyPayment']);
    Route::get('/payment-status/{orderId}', [PaymentController::class, 'paymentStatus'])->name('payment.status');
    Route::get('/order/success', [PaymentController::class, 'orderSuccess'])->name('order.success');
    Route::get('/my-orders', [PaymentController::class, 'myOrders'])->name('my.orders');
});

// Logout
Route::get('/logout', function () {
    auth()->logout();
    request()->session()->forget('user');
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home')->with('success', 'Logged out successfully!');
})->name('logout');


// ==========================================
// Admin Authentication & Admin Panel Routes
// ==========================================

Route::get('/login', function () {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/admin/login', function () {
    return redirect()->route('login');
})->name('admin.login');

Route::get('/signin', function (Request $request) {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('login');
});

Route::post('/signin', function (Request $request) {
    $validate = Validator::make($request->all(), [
        "email" => "required|email",
        "password" => "required",
    ]);

    if ($validate->fails()) {
        return redirect()->back()->withErrors($validate)->withInput();
    }

    $email = trim($request->input('email'));
    $password = (string) $request->input('password');

    // 1. Prioritize an account matching this email that has an existing password
    $user = Login::where('email', $email)
        ->whereNotNull('password')
        ->where('password', '!=', '')
        ->first();

    // 2. Fallback to any account with this email
    if (!$user) {
        $user = Login::where('email', $email)->first();
    }

    $authenticated = false;

    if ($user && !empty($user->password)) {
        // A. Standard Bcrypt verification
        try {
            if (Hash::check($password, $user->password)) {
                $authenticated = true;
            }
        } catch (\Throwable $e) {
            // Password in DB might not use Bcrypt (e.g. plain text or md5 from direct DB edit)
        }

        // B. Fallback: Plain-text password match (e.g., edited directly via phpMyAdmin)
        if (!$authenticated && $password === $user->password) {
            $authenticated = true;
            // Upgrade and securely hash with standard Bcrypt
            $user->password = Hash::make($password);
            $user->save();
        }

        // C. Fallback: MD5 hash match (often selected from phpMyAdmin function dropdown)
        if (!$authenticated && md5($password) === $user->password) {
            $authenticated = true;
            $user->password = Hash::make($password);
            $user->save();
        }

        // D. Fallback: SHA1 hash match
        if (!$authenticated && sha1($password) === $user->password) {
            $authenticated = true;
            $user->password = Hash::make($password);
            $user->save();
        }
    }

    if ($authenticated && $user) {
        $request->session()->put('user', $user);
        return redirect()->route('dashboard');
    } else {
        return redirect()->back()->with('error', 'Email Or Password Invalid !');
    }
})->name('Sign_In');

// Protected Admin Panel
Route::middleware(['authlogin'])->group(function () {

    Route::get('/dashboard', function () {
        $sessionUser = session('user');
        $authUser = auth()->user();

        // Metrics
        $totalServices = Service::count();
        $totalBanners = Banner::count();
        $totalCustomers = User::count();
        $totalBookings = ServiceBooking::count();
        $totalRevenue = ServiceBooking::where('payment_status', 'paid')->sum('amount');
        $newEnquiriesCount = ServiceEnquiry::where('status', 'new')->count();
        $totalCaretakers = \App\Models\Caretaker::count();

        // Recent Bookings, Enquiries & Caretakers
        $recentBookings = ServiceBooking::with('service')->latest()->take(6)->get();
        $recentEnquiries = ServiceEnquiry::with('service')->latest()->take(5)->get();
        $recentCaretakers = \App\Models\Caretaker::latest()->take(5)->get();

        $customerLogins = Login::whereNotNull('name')
            ->where('name', '<>', '')
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact(
            'sessionUser',
            'authUser',
            'totalServices',
            'totalBanners',
            'totalCustomers',
            'totalBookings',
            'totalRevenue',
            'newEnquiriesCount',
            'totalCaretakers',
            'recentBookings',
            'recentEnquiries',
            'recentCaretakers',
            'customerLogins'
        ));
    })->name('dashboard');

    Route::get('/dashboard/export-logins', function () {
        return Excel::download(new \App\Exports\LoginHistoryExport(), 'login_history.xlsx');
    })->name('dashboard.login_export');

    // Admin Profile Management
    Route::get('/admin/profile', function () {
        $userSession = session('user');
        $admin = null;
        if ($userSession && isset($userSession->id)) {
            $admin = Login::find($userSession->id) ?? $userSession;
        } else {
            $admin = Login::whereNotNull('password')->where('password', '!=', '')->first() ?? Login::find(1);
        }
        return view('admin.profile', compact('admin'));
    })->name('admin.profile');

    Route::post('/admin/profile', function (Request $request) {
        $userSession = session('user');
        $adminId = ($userSession && isset($userSession->id)) ? $userSession->id : 1;
        $admin = Login::find($adminId) ?? Login::whereNotNull('password')->where('password', '!=', '')->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Administrator account not found.');
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:logins,email,' . $admin->id,
            'mobile_no' => 'nullable|string|max:15',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->filled('new_password')) {
            $currentMatches = false;
            try {
                if (Hash::check($request->current_password, $admin->password)) {
                    $currentMatches = true;
                }
            } catch (\Throwable $e) {
                // Non-bcrypt stored password handling
            }

            if (!$currentMatches && (
                $request->current_password === $admin->password ||
                md5($request->current_password) === $admin->password ||
                sha1($request->current_password) === $admin->password
            )) {
                $currentMatches = true;
            }

            if (!$currentMatches) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
            $admin->password = Hash::make($request->new_password);
        }

        $admin->email = $request->email;
        if ($request->has('mobile_no')) {
            $admin->mobile_no = $request->mobile_no;
        }
        $admin->save();

        session(['user' => $admin]);

        return redirect()->route('admin.profile')->with('success', 'Administrator profile updated successfully.');
    })->name('admin.profile.update');

    // Service Management (Add, Edit, Delete, View)
    Route::resource('admin/services', ServiceController::class);
    Route::post('admin/services/{service}/sub-services', [SubServiceController::class, 'store'])->name('admin.sub_services.store');
    Route::put('admin/sub-services/{subService}', [SubServiceController::class, 'update'])->name('admin.sub_services.update');
    Route::delete('admin/sub-services/{subService}', [SubServiceController::class, 'destroy'])->name('admin.sub_services.destroy');

    // Banner Management (Add, Edit, Delete, View)
    Route::resource('admin/banners', BannerController::class, ['as' => 'admin']);

    // Customer Details
    Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/customers/{id}', [CustomerController::class, 'show'])->name('admin.customers.show');

    // Service Enquiry Management
    Route::get('/admin/enquiries', [EnquiryController::class, 'index'])->name('admin.enquiries.index');
    Route::get('/admin/enquiries/{id}', [EnquiryController::class, 'show'])->name('admin.enquiries.show');
    Route::post('/admin/enquiries/{id}/status', [EnquiryController::class, 'updateStatus'])->name('admin.enquiries.update_status');
    Route::delete('/admin/enquiries/{id}', [EnquiryController::class, 'destroy'])->name('admin.enquiries.destroy');

    // Service Bookings Management
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/admin/bookings/{id}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');
    Route::post('/admin/bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.update_status');
    Route::post('/admin/bookings/{id}/billing', [AdminBookingController::class, 'updateBilling'])->name('admin.bookings.update_billing');
    Route::delete('/admin/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

    // Caretaker Applications Management
    Route::get('/admin/caretakers', [CaretakerController::class, 'index'])->name('admin.caretakers.index');
    Route::get('/admin/caretakers/create', [CaretakerController::class, 'adminCreate'])->name('admin.caretakers.create');
    Route::post('/admin/caretakers/create', [CaretakerController::class, 'adminStore'])->name('admin.caretakers.admin_store');
    Route::get('/admin/caretakers/{id}', [CaretakerController::class, 'show'])->name('admin.caretakers.show');
    Route::post('/admin/caretakers/{id}/status', [CaretakerController::class, 'updateStatus'])->name('admin.caretakers.update_status');
    Route::delete('/admin/caretakers/{id}', [CaretakerController::class, 'destroy'])->name('admin.caretakers.destroy');

    // GST, Platform & Extra Charges Management
    Route::get('/admin/billing-settings', [AdminBillingSettingController::class, 'index'])->name('admin.billing.index');
    Route::post('/admin/billing-settings', [AdminBillingSettingController::class, 'update'])->name('admin.billing.update');
    Route::post('/admin/billing-settings/services', [AdminBillingSettingController::class, 'updateServicesBilling'])->name('admin.billing.update_services');

    // Website Branding, Logo Text, and Terms & Conditions Management
    Route::get('/admin/website-settings', [AdminWebsiteSettingController::class, 'index'])->name('admin.website_settings.index');
    Route::post('/admin/website-settings', [AdminWebsiteSettingController::class, 'update'])->name('admin.website_settings.update');

    // Existing document legacy management
    Route::resource('admin/documents', DocumentController::class);
    Route::resource('admin/leaders', LeaderController::class);
});
