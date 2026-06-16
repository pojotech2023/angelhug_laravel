<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getLoginForm()
    {
        return view('customerlogin');
    }

    // 🔹 SEND OTP
    public function webLogin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'mobile_no' => 'required|numeric|digits:10'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $mobile = $request->mobile_no;

        // Create user if not exists
        $user = User::firstOrCreate(['mobile_no' => $mobile]);

        $apiKey = env('TWOFACTOR_API_KEY');

        // ✅ Using OTP1 template (same as Postman)
        $url = "https://2factor.in/API/V1/{$apiKey}/SMS/{$mobile}/AUTOGEN/OTP1";

        $response = Http::get($url);

        if ($response->successful() && data_get($response->json(), 'Status') === 'Success') {

            $sessionId = data_get($response->json(), 'Details');

            Session::put('auth_mobile', $mobile);
            Session::put('twofactor_sid', $sessionId);

            return redirect()->route('otp.page');

        } else {
            return back()->withErrors(['otp' => 'OTP sending failed. Please try again.']);
        }
    }

    // 🔹 VERIFY OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        $mobile = Session::get('auth_mobile');
        $sessionId = Session::get('twofactor_sid');

        if (!$mobile || !$sessionId) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired. Try again.']);
        }

        $apiKey = env('TWOFACTOR_API_KEY');

        $url = "https://2factor.in/API/V1/{$apiKey}/SMS/VERIFY/{$sessionId}/{$request->otp}";

        $response = Http::get($url);

        if ($response->successful() && data_get($response->json(), 'Status') === 'Success') {

            $user = User::firstOrCreate(['mobile_no' => $mobile]);

            Auth::login($user);

            // Clear session
            Session::forget(['auth_mobile', 'twofactor_sid']);

            return redirect()->route('cart');

        } else {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    }

    // 🔹 RESEND OTP (optional but useful)
    public function resendOtp()
    {
        $mobile = Session::get('auth_mobile');

        if (!$mobile) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired.']);
        }

        $apiKey = env('TWOFACTOR_API_KEY');

        $url = "https://2factor.in/API/V1/{$apiKey}/SMS/{$mobile}/AUTOGEN/OTP1";

        $response = Http::get($url);

        if ($response->successful() && data_get($response->json(), 'Status') === 'Success') {

            $sessionId = data_get($response->json(), 'Details');
            Session::put('twofactor_sid', $sessionId);

            return back()->with('success', 'OTP resent successfully');

        } else {
            return back()->withErrors(['otp' => 'Failed to resend OTP']);
        }
    }
}