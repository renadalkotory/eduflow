<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Page
    public function showLogin()
    {
        return view('Elearning.login');
    }

    // Show Signup Page
    public function showSignup()
    {
        return view('Elearning.signup');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if account exists
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'This account doesn\'t exist.',
            ])->onlyInput('email');
        }

        // Check password
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->onlyInput('email');
        }

        // Regenerate session
        $request->session()->regenerate();

        // Redirect according to role
        if ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        if ($user->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Fallback
        return redirect('/');
    }


    // Signup
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:student,instructor,admin',
        ], [
            'email.unique' => 'This email is already registered.',
        ]);

       $user = User::create([
    'full_name' => $validated['fullname'],
    'email' => $validated['email'],
    'password' => Hash::make($validated['password']),
    'role' => $validated['role'],
]);
    

        Auth::login($user);

        return redirect('/');
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}