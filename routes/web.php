<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    // the Homepage view is under resources/views/LandingPage/Homepage.blade.php
    return view('LandingPage.Homepage');
});

Route::get('/portfolio', function () {
    return view('LandingPage.Portfolio');
});

Route::get('/contact', function () {
    return view('LandingPage.Contact');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

