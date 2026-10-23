<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtgStatusController;

// Tampilan Halaman Web
Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/form', function () {
    return view('form');
})->name('form');

// API & Action Data
Route::get('/api/rtg-status', [RtgStatusController::class, 'getStatus'])
    ->name('rtg.status');

Route::post('/report/store', [RtgStatusController::class, 'storeReport'])
    ->name('report.store');