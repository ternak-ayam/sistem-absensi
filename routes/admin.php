<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('user', UserController::class)->only('index');
        Route::prefix('barang')->as('barang.')->group(function () {
            Route::get('masuk', [\App\Http\Controllers\BarangMasukController::class, 'index'])->name('masuk.index');
            Route::get('masuk/create', [\App\Http\Controllers\BarangMasukController::class, 'create'])->name('masuk.create');

            Route::get('keluar', [\App\Http\Controllers\BarangKeluarController::class, 'index'])->name('keluar.index');
            Route::get('keluar/create', [\App\Http\Controllers\BarangKeluarController::class, 'create'])->name('keluar.create');
        });
    });
});
