<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Correct import for Auth

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get the credentials from the request
        $credentials = $request->only('email', 'password');

        // Attempt to log in with the provided credentials
        if (Auth::attempt($credentials, $request->remember)) {
            // Redirect to intended page, or '/dashboard' if none
            return redirect()->intended('/dashboard'); // Ensure '/dashboard' is a valid route
        }

        // Redirect back with error message if authentication fails
        return back()->withErrors([
            'email' => 'Your username or password is invalid.',
        ]);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect('/login'); // Redirect to login page
    }
}
