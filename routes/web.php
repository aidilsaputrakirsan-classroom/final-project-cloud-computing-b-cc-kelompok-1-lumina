<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SejarahController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// ======================
// Autentikasi
// ======================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ======================
// Protected routes (harus login)
// ======================
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

// ======================
// Halaman Utama (Home)
// ======================
Route::get('/', function () {
    return view('home');
})->name('home');

// ======================
// Halaman Sejarah
// ======================
Route::get('/', [AuthController::class, 'index'])->name('home');
Route::get('/sejarah', [AuthController::class, 'sejarah'])->name('sejarah');

//===
// Categories
//===
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// ======================
// Logout
// ======================
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
