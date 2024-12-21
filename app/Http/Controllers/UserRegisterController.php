<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRegister;


class UserRegisterController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    // Handle the registration logic
    public function register(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|email|unique:user_registers,email',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user in the database
        UserRegister::create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Redirect to login page or wherever you want after successful registration
        return redirect()->route('forum.index')->with('success', 'Account created successfully');
    }
}
