<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            // Redirect based on role
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Show the registration form
    public function showRegisterForm()
    {
        dd("Running...");
        return view('auth.register');
    }

    // Handle registration request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        dd('Register function called');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the 'User' role by default
        $user->assignRole('User');

        Auth::login($user);

        // Redirect based on role
        return $this->redirectBasedOnRole();
    }

    // Redirect user based on their role
    protected function redirectBasedOnRole()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('Manager')) {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}
