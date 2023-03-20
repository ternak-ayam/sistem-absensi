<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
   Route::get('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
   Route::post('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');

   Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::resource('user', UserController::class)->only('index');

   Route::prefix('barang')->as('barang.')->group(function () {
     Route::get('masuk', [\App\Http\Controllers\BarangMasukController::class, 'index'])->name('masuk.index');
     Route::get('keluar', [\App\Http\Controllers\BarangKeluarController::class, 'index'])->name('keluar.index');
   });
});
