<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    UserController,
    RegisterController
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

    /************************  Register Route ***********************/
Route::any('register',[RegisterController::class,'index'])->name('register');
    /************************  Register Route ***********************/
Route::group(['middleware' => ['web', 'auth']],
    function () {
        Route::get('/welcome', [UserController::class, 'welcome'])->name('welcome');
        Route::resource('/generate/challan', 'App\Http\Controllers\GenerateChallanController');
        //Route::resource('users', 'App\Http\Controllers\UserController');


    });
