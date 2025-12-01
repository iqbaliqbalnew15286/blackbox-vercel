<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\GalleryItemController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Caffe\CaffeHomeController;
use App\Http\Controllers\Salon\SalonHomeController;
use App\Http\Controllers\LayananSalonController;
use App\Http\Controllers\TestimonialSalonController;
use App\Http\Controllers\GallerySalonController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (LANDING PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('welcome');


/*
|--------------------------------------------------------------------------
| 2. CAFÉ PUBLIC ROUTES (URL: /pages/caffe/...)
|--------------------------------------------------------------------------
*/

Route::prefix('pages/caffe')->name('caffe.')->group(function () {
    Route::get('/', [CaffeHomeController::class, 'index'])->name('index');
    Route::get('/ourstory', [CaffeHomeController::class, 'aboutPage'])->name('ourstory');
    Route::get('/ourteam', [CaffeHomeController::class, 'ourTeamPage'])->name('ourteam');
    Route::get('/menu', [CaffeHomeController::class, 'menuPage'])->name('menu');

    // Mengarahkan '/gallery' ke photosPage() (sesuai data yang diambil di controller)
    Route::get('/gallery', [CaffeHomeController::class, 'photosPage'])->name('gallery');

    // Jika Anda ingin tetap mempertahankan /photos sebagai route terpisah:
    Route::get('/photos', [CaffeHomeController::class, 'photosPage'])->name('photos');

    Route::get('/videos', [CaffeHomeController::class, 'videosPage'])->name('videos');
});


/*
|--------------------------------------------------------------------------
| 3. SALON PUBLIC ROUTES (URL: /salon/...)
|--------------------------------------------------------------------------
*/

Route::prefix('salon')->name('salon.')->group(function () {
    Route::get('/', [SalonHomeController::class, 'index'])->name('index');
    Route::get('/layanan', [SalonHomeController::class, 'servicesPage'])->name('layanan');
    Route::get('/menu', [SalonHomeController::class, 'menuPage'])->name('menu');
    Route::get('/about', [SalonHomeController::class, 'aboutPage'])->name('about');
    Route::get('/about/ourteam', [SalonHomeController::class, 'ourTeamPage'])->name('about.ourteam');
    Route::get('/gallery', [SalonHomeController::class, 'galleryPage'])->name('gallery');
    Route::get('/contact', [SalonHomeController::class, 'contactPage'])->name('contact');
    Route::get('/booking', [SalonHomeController::class, 'bookingPage'])->name('booking');
});


/*
|--------------------------------------------------------------------------
| 4. AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset
Route::get('lupa-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('lupa-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');


/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES (CAFFE + SALON)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |---------------------------
    | ADMIN - CAFFE
    |---------------------------
    */
    Route::prefix('admin/caffe')->name('admin.caffe.')->group(function () {

        Route::get('/', fn() => redirect()->route('admin.caffe.dashboard'));

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/curator', [AdminController::class, 'curator'])->name('curator');
        Route::get('/users', [AdminController::class, 'user'])->name('users');

        Route::resource('menu', MenuItemController::class);

        Route::resource('gallery', GalleryItemController::class)->names('gallery');

        Route::resource('testimonial', TestimonialController::class)->names('testimonial');
        Route::resource('ourteam', OurTeamController::class)->names('ourteam');

        Route::post('ourteam/{id}/upload-photo', [OurTeamController::class, 'uploadPhoto'])
            ->name('ourteam.upload-photo');
    });

    /*
    |---------------------------
    | ADMIN - SALON
    |---------------------------
    */
    Route::prefix('admin/salon')->name('admin.salon.')->group(function () {

        Route::get('/', fn() => redirect()->route('admin.salon.dashboard'));

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/curator', [AdminController::class, 'curator'])->name('curator');
        Route::get('/users', [AdminController::class, 'user'])->name('users');

        Route::resource('layanansalon', LayananSalonController::class)->names('layanansalon');
        Route::resource('testimonialsalon', TestimonialSalonController::class)->names('testimonialsalon');

        Route::resource('menu', MenuItemController::class);

        Route::resource('gallery', GallerySalonController::class)->names('gallery');

        Route::resource('ourteam', OurTeamController::class)->names('ourteam');

        Route::post('ourteam/{id}/upload-photo', [OurTeamController::class, 'uploadPhoto'])
            ->name('ourteam.upload-photo');
    });
});
