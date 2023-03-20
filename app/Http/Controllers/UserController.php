<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('user.register');
    }

    // Handle user registration
    public function register(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:20'],
        ]);

        // Create new user in database
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'postal_code' => $validatedData['postal_code'],
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString()
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to dashboard
        return redirect('/dashboard');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('user.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        // Validate login data
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log in user
        if (Auth::attempt($validatedData)) {
            // Redirect to dashboard
            return redirect('/home');
        } else {
            // Return to login form with error message
            return redirect()->back()->withErrors(['email' => 'Incorrect email or password']);
        }
    }
    

    // Handle user logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
