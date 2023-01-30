<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

Route::get('/admin/marketing', [\App\Http\Controllers\Api\V1\Marketing\MarketingController::class, 'index']);
Route::post('/admin/marketing', [\App\Http\Controllers\Api\V1\Marketing\MarketingController::class, 'store']);
