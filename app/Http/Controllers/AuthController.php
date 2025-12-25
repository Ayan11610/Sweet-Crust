<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Unified Login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Unified Login process
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // First, try to authenticate as Staff (User)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/staff/dashboard');
        }

        // If staff login fails, try Customer login
        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/customer/dashboard');
        }

        // If both fail, return error
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Unified Logout
    public function logout(Request $request)
    {
        // Check which guard is authenticated and logout accordingly
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    // Staff Registration page
    public function showStaffRegister()
    {
        return view('staff.register');
    }

    // Staff Registration process
    public function staffRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'roleId' => 'required|integer|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'roleId' => $request->roleId,
            'verified' => false,
        ]);

        $code = rand(100000, 999999);

        VerificationCode::create([
            'email' => $user->email,
            'code' => $code,
            'userType' => 'staff',
            'expiresAt' => now()->addMinutes(15),
        ]);

        $this->sendVerificationEmail($user->email, $code, $user->name);

        return redirect()->route('staff.verify.show')
            ->with('email', $user->email)
            ->with('success', 'Registration successful! Check email.');
    }

    // Customer Registration page
    public function showCustomerRegister()
    {
        return view('customer.register');
    }

    // Customer Registration process
    public function customerRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'verified' => false,
        ]);

        $code = rand(100000, 999999);

        VerificationCode::create([
            'email' => $customer->email,
            'code' => $code,
            'userType' => 'customer',
            'expiresAt' => now()->addMinutes(15),
        ]);

        $this->sendVerificationEmail($customer->email, $code, $customer->name);

        return redirect()->route('customer.verify.show')
            ->with('email', $customer->email)
            ->with('success', 'Registration successful! Check email.');
    }

    // Staff Verification page
    public function showStaffVerify()
    {
        return view('staff.verify');
    }

    // Staff Verification process
    public function staffVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        $verification = VerificationCode::where('email', $request->email)
            ->where('code', $request->code)
            ->where('userType', 'staff')
            ->valid()
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Invalid or expired code']);
        }

        User::where('email', $request->email)->update(['verified' => true]);
        $verification->delete();

        return redirect()->route('staff.setPassword.show')
            ->with('email', $request->email)
            ->with('success', 'Email verified! Set your password.');
    }

    // Customer Verification page
    public function showCustomerVerify()
    {
        return view('customer.verify');
    }

    // Customer Verification process
    public function customerVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        $verification = VerificationCode::where('email', $request->email)
            ->where('code', $request->code)
            ->where('userType', 'customer')
            ->valid()
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Invalid or expired code']);
        }

        Customer::where('email', $request->email)->update(['verified' => true]);
        $verification->delete();

        return redirect()->route('customer.setPassword.show')
            ->with('email', $request->email)
            ->with('success', 'Email verified! Set your password.');
    }

    // Staff Set Password page
    public function showStaffSetPassword()
    {
        return view('staff.set-password');
    }

    // Staff Set Password process
    public function staffSetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Password set successfully! Login now.');
    }

    // Customer Set Password page
    public function showCustomerSetPassword()
    {
        return view('customer.set-password');
    }

    // Customer Set Password process
    public function customerSetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Customer::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Password set! Login now.');
    }

    // Email send helper method
    private function sendVerificationEmail($email, $code, $name)
    {
        Mail::to($email)->send(new VerificationCodeMail($code, $name));
    }
}
