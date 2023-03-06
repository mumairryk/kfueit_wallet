<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    UserController,
    RegisterController,
    GenerateChallanController,
    ChangePasswordController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [LoginController::class, 'auth'])->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('redirectTo', [LoginController::class, 'redirectTo'])->name('redirectTo');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::any('otp',[LoginController::class, 'otpLogin'])->name('otp');
Route::any('forget/password',[LoginController::class, 'forgetPassword'])->name('forget.password');
Route::any('forget/password/update/{uuid}',[LoginController::class, 'forgetPasswordUpdate'])->name('forget.password.update');

    /************************  Register Route ***********************/
Route::any('register',[RegisterController::class,'index'])->name('register');
    /************************  Register Route ***********************/
Route::group(['middleware' => ['web', 'auth']],
    function () {
        Route::get('/welcome', [UserController::class, 'welcome'])->name('welcome');
        Route::resource('/generate/challan', 'App\Http\Controllers\GenerateChallanController');
        Route::any('getdata', [GenerateChallanController::class, 'get_user_history'])->name('getdata');
        Route::any('getsingletrans/{id}', [GenerateChallanController::class, 'get_single_transanction_history'])->name('getsingledata');
        Route::get('balance', [UserController::class, 'show_balance'])->name('balance.show');
        //  Route::get('users', [UserController::class, 'show_data'])->name('users.show');
        //Route::resource('users', 'App\Http\Controllers\UserController');
        Route::get('pending/challah',[UserController::class,'pendingChallah'])->name('pending.challah');
        Route::get('credit/history',[UserController::class,'creditHistory'])->name('credit.history');
        Route::get('debit/history',[UserController::class,'debitHistory'])->name('debit.history');
        Route::get('users',[UserController::class,'index'])->name('users.index');
        Route::any('assign/card/{uuid}',[UserController::class,'assignCard'])->name('assign.card');
        /************************  change password Route ***********************/
        Route::get('change/password',[ChangePasswordController::class,'changePassword'])->name('change.password.index');
        Route::post('change/password/{user}/update',[ChangePasswordController::class,'passwordUpdate'])->name('change.password.update');
        /************************  change password Route ***********************/


    });
