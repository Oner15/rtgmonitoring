<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('landing');
});


Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/form', function () {
    return view('form');
});