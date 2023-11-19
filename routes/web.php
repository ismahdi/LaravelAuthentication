<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginRegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

    /*! Login & Register Routes */
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

    /*! Forgot Password Routes */
Route::controller(ForgotPasswordController::class)->group(function (){
    Route::get('/forget-password', 'showForgetPasswordForm')->name('forget.password.show');
    Route::post('/forget-password', 'submitForgetPassword')->name('forget.password.submit');
    Route::get('/reset-password/{token}', 'showResetPasswordForm')->name('reset.password.show');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.submit');
});
