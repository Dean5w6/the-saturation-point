<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048' 
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $path = null;
        if ($request->hasFile('img_path')) {
            $path = $request->file('img_path')->store('profile_photos', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'img_path' => $path,
            'is_active' => true
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
 
            if (!$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Your account has been deactivated. Contact support.');
            }
 
            if ($user->email_verified_at === null) {
                Auth::logout();
                 
                return back()->with('error', 'You must verify your email address before logging in. Check your inbox.');
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}