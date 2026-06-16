<?php

use App\Models\ApplicationForm;
use App\Models\Login;
use App\Models\User;
use App\Models\Document;
use App\Models\Leader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ApplicationFormController;
use App\Exports\ApplicationFormsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/list/{type}', [CourseController::class, 'frontentview'])->name('courses');
Route::get('/course/{id}', [CourseController::class, 'show'])->name('course.details');
// Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('add.to.cart');
// Route::get('/cart', [CartController::class, 'cart'])->name('cart');
// Route::get('/cart/remove/{id}', function ($id) {
//     $cart = session()->get('cart');

//     if(isset($cart[$id])) {
//         unset($cart[$id]);
//         session()->put('cart', $cart);
//     }

//     return redirect()->route('cart')->with('success', 'Item removed from cart');
// })->name('cart.remove');

// Route::get('/course', function () {
//     return view('course');
// })->name('course');

Route::get('/board_direct', function () {
    return view('board_direct');
})->name('board_direct');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/service', [ServiceController::class, 'serviceview'])->name('service');
Route::get('/service/{id}', [ServiceController::class, 'servicedetails'])->name('servicedetails');


Route::get('/login', function () {
    return view('login');
})->name('login');
// Route::get('/customerlogin', [AuthController::class, 'getLoginForm'])->name('cuslogin');
// Route::post('/customerlogin', [AuthController::class, 'webLogin'])->name('login.submit');
// Route::get('/otp', function () {
//     return view('otp_verification');
// })->name('otp.page');
// Route::post('/otp-verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');

Route::get('/application', function () {
    return view('application_form');
})->name('application');




Route::get('/signin', function (Request $request) {
    $applications = ApplicationForm::paginate(10);
    return view('dashboard', compact('applications'));
});

Route::post('/signin', function (Request $request) {
    $validate = Validator::make($request->all(), [
        "email" => "required|email",
        "password" => "required",
    ]);

    if ($validate->fails()) {
        return redirect()->back()->withErrors($validate)->withInput();
    }

    $email = $request->input('email');
    $password = $request->input('password');

    $user = Login::where('email', $email)->first();
    if ($user && Hash::check($password, $user->password)) {
        // Save user to session
        $request->session()->put('user', $user);

        return redirect()->route('dashboard');
    } else {
        return redirect()->back()->with('error', 'Email Or Password Invalid !');
    }
})->name('Sign_In');
Route::middleware(['authlogin'])->group(function () {
    Route::get('/dashboard', function () {
        $sessionUser = session('user');
        $authUser = auth()->user();
        $customerUsers = \App\Models\User::orderBy('created_at', 'desc')->get();
        $customerLogins = \App\Models\Login::whereNotNull('name')
            ->where('name', '<>', '')
            ->whereNotNull('email')
            ->where('email', '<>', '')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
        return view('dashboard', compact('sessionUser', 'authUser', 'customerUsers', 'customerLogins'));
    })->name('dashboard');

    Route::get('/dashboard/export-logins', function () {
        return Excel::download(new \App\Exports\LoginHistoryExport(), 'login_history.xlsx');
    })->name('dashboard.login_export');
    
    Route::resource('admin/documents', DocumentController::class);
    Route::resource('admin/leaders', LeaderController::class);
    Route::resource('admin/courses', CourseController::class);
    
    Route::get('/admin/book/view', [CourseController::class, 'bookindex'])->name('book.view');
    Route::get('/admin/book/create', [CourseController::class, 'createBook'])->name('book.create');
    Route::post('/admin/book/store', [CourseController::class, 'storeBook'])->name('book.store');
    Route::get('/admin/book/edit/{id}', [CourseController::class, 'editBook'])->name('book.edit');
    Route::post('/admin/book/update', [CourseController::class, 'updateBook'])->name('book.update');
    Route::get('/admin/purchased-list', [PaymentController::class, 'purchasedList'])->name('admin.purchased_list');
});


//payment gateway


// Customer Login Routes (Public)
Route::get('/customer/login', [PaymentController::class, 'getLoginForm'])->name('customer.login');
Route::post('/customer/login', [PaymentController::class, 'webLogin'])->name('login.submit');
Route::get('/customer/otp', function() { return view('otp_verification'); })->name('otp.page');
Route::post('/customer/verify-otp', [PaymentController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/customer/resend-otp', [PaymentController::class, 'resendOtp'])->name('otp.resend');

// Cart Routes (Public)
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
 Route::get('/logout', function () {
        auth()->logout();
        request()->session()->forget('user');
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully!');
    })->name('logout');


// excel upload processing









// excel upload form
//Route::get('/form-import', [ApplicationFormController::class, 'showExcelImportForm'])->name('form-import');
