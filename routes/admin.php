<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\User\Presensi\PresensiController as PegawaiPresensiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('user')->as('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::put('{user}', [UserController::class, 'update'])->name('update');
            Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::get('{user}/delete', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('absensi-pegawai')->as('pegawai.presence.')->group(function () {
            Route::get('/', [PegawaiPresensiController::class, 'index'])->name('index');
            Route::get('create', [PegawaiPresensiController::class, 'create'])->name('create');
        });

        Route::prefix('presensi')->as('presence.')->group(function () {
            Route::get('/', [PresensiController::class, 'index'])->name('index');
            Route::get('create', [PresensiController::class, 'create'])->name('create');
        });
    });
});
