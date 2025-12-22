<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StaffAuthController extends Controller
{
    // Staff registration page dikhana
    public function showRegister()
    {
        return view('staff.register');
    }

    // Staff registration process karna
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'roleId' => 'required|integer|exists:roles,id',
        ]);

        // User create karna (without password)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'roleId' => $request->roleId,
            'verified' => false,
        ]);

        // 6-digit verification code generate karna
        $code = rand(100000, 999999);

        // Verification code database mein save karna
        VerificationCode::create([
            'email' => $user->email,
            'code' => $code,
            'userType' => 'staff',
            'expiresAt' => now()->addMinutes(15),
        ]);

        // Email send karna
        $this->sendVerificationEmail($user->email, $code);

        return redirect()->route('staff.verify.show')
            ->with('email', $user->email)
            ->with('success', 'Registration successful! Check email.');
    }

    // Verification page dikhana
    public function showVerify()
    {
        return view('staff.verify');
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
            ->where('userType', 'staff')
            ->valid()
            ->first();

        if (!$verification) {
            return back()->withErrors(['code' => 'Invalid or expired code']);
        }

        // User ko verified mark karna
        User::where('email', $request->email)->update(['verified' => true]);

        // Verification code delete karna
        $verification->delete();

        return redirect()->route('staff.setPassword.show')
            ->with('email', $request->email)
            ->with('success', 'Email verified! Set your password.');
    }

    // Set password page dikhana
    public function showSetPassword()
    {
        return view('staff.set-password');
    }

    // Password set karna
    public function setPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Password update karna
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('staff.login.show')
            ->with('success', 'Password set successfully! Login now.');
    }

    // Login page dikhana
    public function showLogin()
    {
        return view('staff.login');
    }

    // Login process karna
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('staff.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Logout karna
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login.show');
    }

    // Email send karne ka helper method
    private function sendVerificationEmail($email, $code)
    {
        $user = User::where('email', $email)->first();
        Mail::to($email)->send(new VerificationCodeMail($code, $user->name));
    }
}
