<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    // Controller
    public function showLoginForm()
{
    return view('auth.login'); // file: resources/views/auth/login.blade.php
}


    public function showRegisterForm()
{
    return view('auth.register');
}
// Tampilkan register
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);
    Auth::login($user);
    return redirect()->route('account');
}

    public function account()
{
    return view('auth.account');
}

}
