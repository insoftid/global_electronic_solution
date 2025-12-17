<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // the Homepage view is under resources/views/LandingPage/Homepage.blade.php
    return view('LandingPage.Homepage');
});

Route::get('/produk', function () {
    return view('LandingPage.Portfolio');
});

Route::get('/produk/{id}', function ($id) {
    return view('LandingPage.PortDetail');
});

Route::get('/contact', function () {
    return view('LandingPage.Contact');
});

Route::get('/welcome', function () {
    return view('welcome');
});

// Route::get('/admin/login', function () {
//     return view('Admin.Login');
// });

Route::get('/admin', function () {
    return view('Admin.Dashboard');
});

Route::get('/admin/settings', function () {
    return view('Admin.Settings');
});

Route::get('/admin/landing-page', function () {
    return view('Admin.LandingPage');
});

Route::get('/admin/contacts', function () {
    return view('Admin.Contacts');
});

Route::get('/admin/users', function () {
    return view('Admin.Users');
});