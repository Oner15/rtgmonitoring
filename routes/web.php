<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtgStatusController;
use App\Http\Controllers\WorkOrderController;


// Tampilan Halaman Web
Route::get('/', function () {
    return view('landing');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/form', function () {
    return view('form');
<<<<<<< HEAD
})->name('form');

// API & Action Data (Menggunakan string Controller)
Route::get('/api/rtg-status', 'App\Http\Controllers\RtgStatusController@getStatus')->name('rtg.status');
Route::post('/report/store', 'App\Http\Controllers\RtgStatusController@storeReport')->name('report.store');
Route::post('/rtg/import', 'App\Http\Controllers\RtgStatusController@importExcel')->name('rtg.import');
=======
});

// API Routes
Route::get('/api/rtg-status', [RtgStatusController::class, 'getStatus']);
Route::post('/api/import-excel', [RtgStatusController::class, 'importExcel']);

// Work Order / Penanganan Routes
Route::get('/penanganan', [WorkOrderController::class, 'index']);
Route::post('/penanganan', [WorkOrderController::class, 'store']);
Route::patch('/penanganan/{workOrder}/status', [WorkOrderController::class, 'updateStatus']);
Route::delete('/penanganan/{workOrder}', [WorkOrderController::class, 'destroy']);
>>>>>>> 5d89033e (penanganan.blade.)
