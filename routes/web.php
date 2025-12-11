<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect('/auth/login');
// });

Route::middleware('prevent.auth')->group(function () {
    // Hanya boleh diakses kalau BELUM login
    Route::get('/', [UserController::class, 'index'])->name('/');

    // BLOG PUBLIC — hanya guest
    Route::get('/blog', [PostController::class, 'index'])->name('blog');
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
    Route::get('/user/postingan-saya', [UserDashboardController::class, 'page_postingan_allByUser'])
        ->name('user.postingan-saya');
    Route::post('/user/postingan-saya/create', [UserDashboardController::class, 'page_create_post'])
        ->name('page.create');
    Route::post('/user/postingan-saya/create', [UserDashboardController::class, 'create_post'])
        ->name('aksi.create');
    Route::get('/user/postingan-saya/show/{slug}', [UserDashboardController::class, 'show_blogBySlug'])
        ->name('posts.show');
    Route::get('/user/postingan-saya/{slug}/update', [UserDashboardController::class, 'edit_postBySlug'])
        ->name('page.update');
    Route::put('/user/postingan-saya/{slug}', [UserDashboardController::class, 'aksi_update'])
        ->name('aksi.update');
    Route::delete('/user/postingan-saya/delete/{id}', [UserDashboardController::class, 'delete_blog'])
        ->name('posts.destroy');
});

// Halaman yang butuh login + role ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});
