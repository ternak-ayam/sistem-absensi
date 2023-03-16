<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::group([], function () {
   Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::resource('user', UserController::class)->only('index');

   Route::prefix('barang')->as('barang.')->group(function () {
     Route::get('masuk', [\App\Http\Controllers\BarangMasukController::class, 'index'])->name('masuk.index');
     Route::get('keluar', [\App\Http\Controllers\BarangKeluarController::class, 'index'])->name('keluar.index');
   });
});
