<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\UserData;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('otpLogin', [AuthController::class, 'check_otp']);
Route::post('gettoken', [AuthController::class, 'gettoken']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('getsum', [UserData::class, 'getsum']);
    Route::post('getusertransaction', [UserData::class, 'getusertransaction']);
    Route::post('add_transaction_detail', [UserData::class, 'add_transaction_detail']);
    //Route::resource('blogs', BlogController::class);
});
