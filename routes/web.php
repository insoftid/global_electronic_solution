<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // the Homepage view is under resources/views/LandingPage/Homepage.blade.php
    return view('LandingPage.Homepage');
});

Route::get('/welcome', function () {
    return view('welcome');
});


