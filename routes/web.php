<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // the Homepage view is under resources/views/LandingPage/Homepage.blade.php
    return view('LandingPage.Homepage');
});

Route::get('/portfolio', function () {
    return view('LandingPage.Portfolio');
});

Route::get('/portfolio/{id}', function ($id) {
    return view('LandingPage.PortDetail');
});

Route::get('/contact', function () {
    return view('LandingPage.Contact');
});

Route::get('/welcome', function () {
    return view('welcome');
});


