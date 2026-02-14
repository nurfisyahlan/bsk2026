<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IuranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route di sini otomatis prefix /api
| Cocok untuk Postman, AJAX, fetch, dll
|--------------------------------------------------------------------------
*/

// sanity check (opsional, tapi enak buat test)
Route::get('/ping', function () {
    return response()->json([
        'status' => 'API OK',
        'time'   => now()
    ]);
});

/*
|--------------------------------------------------------------------------
| Iuran API
|--------------------------------------------------------------------------
*/

// simpan pembayaran iuran per bulan
Route::post('/iuran/bulanan', [IuranController::class, 'storeBulanan'])
    ->name('api.iuran.storeBulanan');
