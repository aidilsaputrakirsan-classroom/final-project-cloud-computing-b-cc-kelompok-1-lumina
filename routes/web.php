<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

// Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes hanya bisa diakses jika sudah login
Route::middleware(['web', 'auth'])->group(function() {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});
// edit profile
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->middleware('auth')->name('profile.edit');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

// Tampilkan form edit
Route::get('/profile/edit', [AuthController::class, 'editProfile'])->middleware('auth')->name('profile.edit');

// Proses update (post)
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

// Home page akses umum (tidak wajib login):
Route::get('/', function () {
    return view('home');
})->name('home');

// Logout
Route::get('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');