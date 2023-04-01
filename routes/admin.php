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

        Route::prefix('user')->as('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::put('{admin}', [UserController::class, 'update'])->name('update');
            Route::get('{admin}/edit', [UserController::class, 'edit'])->name('edit');
            Route::get('{admin}/delete', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('barang')->as('barang.')->group(function () {
            Route::prefix('kelola')->group(function () {
                Route::get('/', [\App\Http\Controllers\BarangController::class, 'index'])->name('index');
                Route::get('create', [\App\Http\Controllers\BarangController::class, 'create'])->name('create');
                Route::get('{product}/edit', [\App\Http\Controllers\BarangController::class, 'edit'])->name('edit');
                Route::get('{product}/delete', [\App\Http\Controllers\BarangController::class, 'destroy'])->name('destroy');
                Route::get('export', [\App\Http\Controllers\BarangController::class, 'export'])->name('export');
                Route::post('/', [\App\Http\Controllers\BarangController::class, 'store'])->name('store');
                Route::put('{product}', [\App\Http\Controllers\BarangController::class, 'update'])->name('update');
            });

            Route::prefix('retur')->as('return.')->group(function () {
                Route::get('/', [\App\Http\Controllers\ReturnBarangController::class, 'index'])->name('index');
                Route::get('/{product}/edit', [\App\Http\Controllers\ReturnBarangController::class, 'edit'])->name('edit');
                Route::put('/{product}', [\App\Http\Controllers\ReturnBarangController::class, 'update'])->name('update');
            });

            Route::get('list', [\App\Http\Controllers\BarangListController::class, 'index'])->name('list.index');
            Route::get('list/create', [\App\Http\Controllers\BarangListController::class, 'create'])->name('list.create');
            Route::post('list', [\App\Http\Controllers\BarangListController::class, 'store'])->name('list.store');
            Route::get('list/{product}/delete', [\App\Http\Controllers\BarangListController::class, 'destroy'])->name('list.destroy');

            Route::get('masuk', [\App\Http\Controllers\BarangMasukController::class, 'index'])->name('masuk.index');
            Route::get('keluar', [\App\Http\Controllers\BarangKeluarController::class, 'index'])->name('keluar.index');
            Route::get('keluar/{product}/edit', [\App\Http\Controllers\BarangKeluarController::class, 'edit'])->name('keluar.edit');
            Route::put('keluar/{product}', [\App\Http\Controllers\BarangKeluarController::class, 'update'])->name('keluar.update');

        });

        Route::get('laporan', [\App\Http\Controllers\LaporanBarangController::class, 'index'])->name('laporan.index');
    });
});
