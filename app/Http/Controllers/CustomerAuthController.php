<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerAuthController extends Controller
{
    // Customer registration page dikhana
    public function showRegister()
    {
        return view('customer.register');
    }

    // Customer registration process karna
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Customer create karna (without password)
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'verified' => false,
        ]);

        // 6-digit verification code generate karna
        $code = rand(100000, 999999);

        // Verification code save karna
        VerificationCode::create([
            'email' => $customer->email,
            'code' => $code,
            'userType' => 'customer',
            'expiresAt' => now()->addMinutes(15),
        ]);

        // Email send karna
        $this->sendVerificationEmail($customer->email, $code);

        return redirect()->route('customer.verify.show')
            ->with('email', $customer->email)
            ->with('success', 'Registration successful! Check email.');
    }

    // Verification page dikhana
    public function showVerify()
    {
        return view('customer.verify');
    }

    // Verification code verify karna
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        // Valid code check karna
        $verification = VerificationCode::where('email', $request->email)
            ->where('code', $request->code)
            ->where('userType', 'customer')
            ->valid()
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Invalid or expired code']);
        }

        // Customer ko verified mark karna
        Customer::where('email', $request->email)
            ->update(['verified' => true]);

        // Verification code delete karna
        $verification->delete();

        return redirect()->route('customer.setPassword.show')
            ->with('email', $request->email)
            ->with('success', 'Email verified! Set your password.');
    }

    // Set password page dikhana
    public function showSetPassword()
    {
        return view('customer.set-password');
    }

    // Password set karna
    public function setPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Password update karna
        Customer::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.login.show')
            ->with('success', 'Password set! Login now.');
    }

    // Login page dikhana
    public function showLogin()
    {
        return view('customer.login');
    }

    // Login process karna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout karna
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('customer.login.show');
    }

    // Email send karne ka helper method
    private function sendVerificationEmail($email, $code)
    {
        $customer = Customer::where('email', $email)->first();
        Mail::to($email)->send(new VerificationCodeMail($code, $customer->name));
    }
}
