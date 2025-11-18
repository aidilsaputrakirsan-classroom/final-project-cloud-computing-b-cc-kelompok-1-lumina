<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\SearchController; // Untuk search dan autosuggest
use App\Models\Category;
use App\Models\Destination;
use App\Models\History;


// Home
Route::get('/', function () {
    $categories = Category::all();
    $histories = History::where('is_published', true)
        ->orderByDesc('published_at')
        ->take(6)
        ->get();
    return view('home', compact('categories', 'histories'));
})->name('home');

// Halaman Wisata publik
Route::get('/wisata', function () {
    $categories = Category::all();
    $destinations = Destination::latest()->paginate(9);
    return view('wisata.index', compact('categories', 'destinations'));
})->name('wisata.index');

// Halaman Categories
Route::get('/categories', [SejarahController::class, 'categories'])->name('categories');

// Halaman Sejarah publik
Route::prefix('sejarah')->group(function () {
    Route::get('/', [SejarahController::class, 'index'])->name('sejarah.index');
    Route::get('/{history:slug}', [SejarahController::class, 'show'])->name('sejarah.show');
});

// ------------------- SEARCH / AUTOSUGGEST ------------------- //

// Halaman hasil pencarian biasa
Route::get('/search', [SearchController::class, 'search'])->name('search');

// Endpoint AJAX untuk autosuggest navbar
Route::get('/search/autosuggest', [SearchController::class, 'autosuggest'])
    ->name('search.autosuggest');

// ------------------- AUTHENTICATION (Guest Only) ------------- //

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ------------------- LOGOUT (Auth Only) ---------------------- //

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->middleware('auth')->name('logout');

// ------------------- PROTECTED ROUTES (AUTH ONLY) ------------ //

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [AuthController::class, 'profile'])->name('profile');
        Route::get('/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
        Route::post('/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    });

    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    })->name('dashboard');
});

// ------------------- ADMIN ROUTES (Only Admin) -------------- //

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/dashboard/users/{id}/make-admin', [DashboardController::class, 'makeAdmin'])->name('dashboard.makeAdmin');
        Route::put('/dashboard/users/{id}', [DashboardController::class, 'updateUser'])->name('dashboard.updateUser');
        Route::delete('/dashboard/users/{id}', [DashboardController::class, 'deleteUser'])->name('dashboard.deleteUser');

        // CRUD Category
        Route::resource('categories', CategoryController::class);

        // CRUD History
        Route::resource('histories', HistoryController::class);

        // CRUD Destination
        Route::resource('destinations', DestinationController::class);
    });
});
