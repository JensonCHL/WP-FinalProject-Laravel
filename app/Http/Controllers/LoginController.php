<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRegister;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            // 'email' => 'required|email',
            // 'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            // Redirect to the desired page after successful login (e.g., forum page or home)
            return redirect()->route('forum.index')->with('success', 'Logged in successfully');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout logic
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
