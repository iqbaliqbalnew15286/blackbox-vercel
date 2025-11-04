<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PromoItemController;
use App\Http\Controllers\GalleryItemController;
use App\Http\Controllers\ImageController; 
use App\Http\Controllers\WritingController; 
// =========================================================
// 1. RUTE PUBLIK (LANDING PAGE)
// =========================================================

Route::get('/', function () {
    // Ini akan menjadi halaman depan kafe Anda
    return view('welcome');
});


// =========================================================
// 2. RUTE AUTENTIKASI
// =========================================================

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rute Password Reset
Route::get('lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


// =========================================================
// 3. RUTE ADMIN (WARUNG KOPI PANEL)
// =========================================================
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/curator', [AdminController::class, 'curator'])->name('admin.curator');
    Route::get('/admin/users', [AdminController::class, 'user'])->name('admin.users');

    // Rute resource menu
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('menu', MenuItemController::class);
        Route::resource('promo', PromoItemController::class);
        Route::resource('gallery', GalleryItemController::class);
        Route::resource('image', ImageController::class)->except(['create']);
        Route::resource('writings', WritingController::class);
    });
});
