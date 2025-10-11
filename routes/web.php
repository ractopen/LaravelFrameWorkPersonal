<?php

/**
 * WEB ROUTES - POSTGRESQL LOGIN/REGISTER SYSTEM
 * 
 * This file defines all routes for the authentication system
 * All user data is stored in PostgreSQL database (configured in .env)
 * 
 * IMPORTANT: Before using, ensure:
 * 1. PostgreSQL is running
 * 2. Database is created in pgAdmin
 * 3. .env file has correct PostgreSQL credentials
 * 4. Run: php artisan migrate (to create tables in PostgreSQL)
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * HOME/DASHBOARD ROUTE
 * Shows welcome page after successful login
 * If not logged in, redirect to login
 */
Route::get('/', function () {
    // Check if user is logged in
    if (!session('user_id')) {
        return redirect('/login');
    }
    return view('welcome');
});

/**
 * REGISTRATION ROUTES
 * GET /register - Display registration form
 * POST /register - Process registration, save to PostgreSQL
 */
Route::get('/register', function () {
    return view('register');
});

// POST /register - Handle registration
Route::post('/register', function (Request $request) {
    // Check if email already exists
    $existingUser = User::where('email', $request->email)->first();
    
    if ($existingUser) {
        return back()->with('error', 'User already exists');
    }
    
    // Create new user with plain text password
    $user = new User();
    $user->email = $request->email;
    $user->password = $request->password;  // Plain text password
    $user->save();
    
    return redirect('/login')->with('success', 'Registration successful! Please login.');
});

/**
 * LOGIN ROUTES
 * GET /login - Display login form
 * POST /login - Authenticate user against PostgreSQL database
 */
Route::get('/login', function () {
    return view('login');
});

// POST /login - Handle login
Route::post('/login', function (Request $request) {
    // Find user by email
    $user = User::where('email', $request->email)->first();
    
    // Check if user exists and password matches (plain text comparison)
    if ($user && $user->password === $request->password) {
        // Login success - store user info in session
        session(['user_id' => $user->id, 'user_email' => $user->email]);
        return redirect('/')->with('success', 'Login successful!');
    }
    
    // Login failed
    return back()->with('error', 'Invalid credentials');
});

/**
 * LOGOUT ROUTE
 * POST /logout - Clear session and log user out
 */
Route::post('/logout', function () {
    // Clear session
    session()->flush();
    return redirect('/login')->with('success', 'Logged out successfully');
});
