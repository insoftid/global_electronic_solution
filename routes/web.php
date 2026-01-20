<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingPage\HomeController;
use App\Http\Controllers\LandingPage\PortfolioController;
use App\Http\Controllers\LandingPage\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\GalleryController;

/*
|--------------------------------------------------------------------------
| Landing Page Routes (Public)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/produk/search', [PortfolioController::class, 'searchAjax'])->name('portfolio.search');
Route::get('/produk/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/welcome', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by Auth Middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/identity', [SettingController::class, 'updateIdentity'])->name('settings.identity');
    Route::post('/settings/about', [SettingController::class, 'updateAbout'])->name('settings.about');
    Route::post('/settings/contact', [SettingController::class, 'updateContact'])->name('settings.contact');
    Route::post('/settings/social', [SettingController::class, 'updateSocial'])->name('settings.social');
    
    // Landing Page Management (Portfolio)
    Route::get('/landing-page', [AdminPortfolioController::class, 'index'])->name('landing-page');
    Route::post('/portfolios', [AdminPortfolioController::class, 'store'])->name('portfolios.store');
    Route::get('/portfolios/{portfolio}', [AdminPortfolioController::class, 'show'])->name('portfolios.show');
    Route::put('/portfolios/{portfolio}', [AdminPortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [AdminPortfolioController::class, 'destroy'])->name('portfolios.destroy');
    Route::post('/portfolios/{portfolio}/images', [AdminPortfolioController::class, 'uploadImages'])->name('portfolios.images.upload');
    Route::delete('/portfolio-images/{portfolioImage}', [AdminPortfolioController::class, 'deleteImage'])->name('portfolios.images.delete');
    
    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::put('/certificates/{certificate}', [CertificateController::class, 'update'])->name('certificates.update');
    Route::delete('/certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy');
    
    // Partners
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    
    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery/{galleryPhoto}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{galleryPhoto}/image', [GalleryController::class, 'removeImage'])->name('gallery.remove-image');
    
    // Contact Messages
    Route::get('/contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contactMessage}', [ContactMessageController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('contacts.status');
    Route::patch('/contacts/{contactMessage}/note', [ContactMessageController::class, 'addNote'])->name('contacts.note');
    Route::delete('/contacts/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');
    
    // Users Management (Superadmin Only)
    Route::middleware('superadmin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});