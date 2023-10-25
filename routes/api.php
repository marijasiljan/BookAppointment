<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Backend;
//use App\Http\Controllers\Backend\Auth;

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

Route::post('/register', [Backend\Auth\AuthController::class, 'register']);
Route::post('/login', [Backend\Auth\AuthController::class, 'login']);

Route::group(['prefix' => '/password'], function () {
    Route::post('/reset', [Backend\Auth\PasswordController::class, 'resetPassword']);
    Route::post('/email', [Backend\Auth\PasswordController::class, 'sendResetLinkEmail']);
    Route::post('/verify', [Backend\Auth\VerifyController::class, 'verifyCode']);
});

Route::group(['prefix' => '/services'], function () {
    Route::get('/', [Backend\ServiceController::class, 'index']);
    Route::post('/store', [Backend\ServiceController::class, 'store']);
    Route::delete('/{id}/delete', [Backend\ServiceController::class, 'destroy']);
});

Route::group(['prefix' => '/user'], function () {
    Route::get('/', [Backend\UsersController::class, 'index']);
    Route::post('/store', [Backend\UsersController::class, 'store']);
    Route::delete('/{id}/delete', [Backend\UsersController::class, 'destroy']);
});

Route::group(['prefix' => '/price'], function () {
    Route::get('/', [Backend\PriceController::class, 'index']);
    Route::post('/store', [Backend\PriceController::class, 'store']);
    Route::delete('/{id}/delete', [Backend\PriceController::class, 'destroy']);
});

Route::group(['prefix' => '/booking'], function () {
    Route::get('/', [Backend\BookingTimeController::class, 'index']);
    Route::post('/store', [Backend\BookingTimeController::class, 'store']);
    Route::post('/{id}/delete', [Backend\BookingTimeController::class, 'destroy']);
});

Route::group(['prefix' => '/appointments'], function () {
    Route::get('/', [Backend\AppointmentController::class, 'index']);
    Route::post('/store', [Backend\AppointmentController::class, 'store']);
    Route::post('/{id}/delete', [Backend\AppointmentController::class, 'destroy']);
});

Route::group(['prefix' => '/affiliates'], function () {
    Route::get('/', [Backend\AffiliateController::class, 'index']);
    Route::post('/store', [Backend\AffiliateController::class, 'store']);
    Route::delete('/{id}/delete', [Backend\AffiliateController::class, 'destroy']);
});


