<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;

// Route::get('/', function () {
//     return redirect('/auth/login');
// });

Route::middleware('prevent.auth')->group(function () {
    // Hanya boleh diakses kalau BELUM login
    Route::get('/', [UserController::class, 'index']);

    // BLOG PUBLIC — hanya guest
    Route::get('/blog', [PostController::class, 'index']);
    Route::get('/blog/{slug}', [PostController::class, 'blogBySlug']);

    // AUTH — hanya guest
    Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/auth/register', [AuthController::class, 'register']);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('auth/login');
})->name('logout');

// Halaman yang butuh login + role USER
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');
});

// Halaman yang butuh login + role ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

 
