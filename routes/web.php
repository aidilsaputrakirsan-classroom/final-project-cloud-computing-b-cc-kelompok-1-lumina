<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller imports
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HistoryController;

/*
|--------------------------------------------------------------------------
| ROUTES PUBLIK
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Categories (static)
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Halaman publik: Daftar & detail sejarah
Route::get('/sejarah', [SejarahController::class, 'index'])->name('sejarah.index');
Route::get('/sejarah/{slug}', [SejarahController::class, 'show'])->name('sejarah.show');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| LOGOUT (Auth Only)
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (AUTH ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Profile User
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    // Redirect dashboard ke admin
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Category (Kategori)
        Route::resource('categories', CategoryController::class);

        // CRUD History (Sejarah)
        Route::resource('histories', HistoryController::class);
    });
});
