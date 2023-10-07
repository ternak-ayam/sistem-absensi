<?php

use App\Http\Controllers\User\Presensi\PresensiController as PegawaiPresensiController;
use App\Http\Controllers\Admin\PresensiController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Dashboard\DashboardController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->as('user.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::put('/', [UserController::class, 'update'])->name('update');


    Route::prefix('presensi-pegawai')->as('presence.user.')->group(function () {
        Route::get('/{presence}', [PegawaiPresensiController::class, 'index'])->name('index');
        Route::get('/{code}/create', [PegawaiPresensiController::class, 'store'])->name('store');
    });

    Route::prefix('presensi')->as('presence.')->group(function () {
        Route::get('/', [PresensiController::class, 'index'])->name('index');
    });
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
