<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\TanggunganController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PengumumanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| KELUARGA
|--------------------------------------------------------------------------
*/

Route::resource('keluarga', KeluargaController::class)
    ->parameters([
        'keluarga' => 'no_bsk'
    ]);

Route::get('keluarga/{no_bsk}', [KeluargaController::class, 'detail'])
    ->name('keluarga.detail');

/*
|--------------------------------------------------------------------------
| TANGGUNGAN
|--------------------------------------------------------------------------
*/

Route::post('keluarga/{no_bsk}/tanggungan', [TanggunganController::class, 'store'])
    ->name('tanggungan.store');

Route::get('keluarga/{no_bsk}/tanggungan/create', [TanggunganController::class, 'create'])
    ->name('tanggungan.create');

Route::get('keluarga/{no_bsk}/tanggungan/{id}/edit', [TanggunganController::class, 'edit'])
    ->name('tanggungan.edit');

Route::put('keluarga/{no_bsk}/tanggungan/{id}', [TanggunganController::class, 'update'])
    ->name('tanggungan.update');

Route::delete('keluarga/{no_bsk}/tanggungan/{id}', [TanggunganController::class, 'destroy'])
    ->name('tanggungan.destroy');

/*
|--------------------------------------------------------------------------
| SALDO
|--------------------------------------------------------------------------
*/

Route::resource('saldo', SaldoController::class)
    ->except(['create', 'edit', 'show']);

/*
|--------------------------------------------------------------------------
| IURAN  ✅ (INI YANG KITA TAMBAHIN)
|--------------------------------------------------------------------------
*/

Route::prefix('iuran')->group(function () {

    Route::get('/', [IuranController::class, 'index'])
        ->name('iuran.index');

    // CREATE + EDIT (bulan baru)
    Route::post('/bulanan', [IuranController::class, 'storeBulanan'])
        ->name('iuran.storeBulanan');

    Route::delete('/{iuran}', [IuranController::class, 'destroy'])
        ->name('iuran.destroy');
});

Route::resource('inventaris', InventarisController::class);            


// PENGUMUMAN
Route::resource('pengumuman', PengumumanController::class)
    ->except(['create', 'edit', 'show']); 