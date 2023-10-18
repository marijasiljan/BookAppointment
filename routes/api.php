<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/services'], function () {
    Route::get('/', [Backend\ServiceController::class, 'index']);
    Route::post('/', [Backend\ServiceController::class, 'store']);
});

Route::group(['prefix' => '/user'], function () {
    Route::get('/', [Backend\UsersController::class, 'index']);
    Route::post('/', [Backend\UsersController::class, 'store']);
});

Route::group(['prefix' => '/price'], function () {
    Route::get('/', [Backend\PriceController::class, 'index']);
    Route::post('/', [Backend\PriceController::class, 'store']);
});

Route::group(['prefix' => '/booking'], function () {
    Route::get('/', [Backend\BookingTimeController::class, 'index']);
    Route::post('/', [Backend\BookingTimeController::class, 'store']);
});

Route::group(['prefix' => '/appointments'], function () {
    Route::get('/', [Backend\AppointmentController::class, 'index']);
    Route::post('/', [Backend\AppointmentController::class, 'store']);
});

Route::group(['prefix' => '/affiliates'], function () {
    Route::get('/', [Backend\AffiliateController::class, 'index']);
    Route::post('/', [Backend\AffiliateController::class, 'store']);
});


