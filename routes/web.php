<?php

use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ResetPasswordController;
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
    return view('auth.login');
});

/*! Login & Register Routes */
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

/*! Forget and Reset Password Routes */
Route::group(['prefix' => 'password'], function () {
    Route::get('/reset', [ForgetPasswordController::class, 'showForgetPasswordForm'])
        ->name('ForgetPasswordShow');

    Route::post('/email', [ForgetPasswordController::class, 'submitForgetPassword'])
        ->name('ForgetPasswordSubmit');

    Route::get('/reset/{token}',[ResetPasswordController::class, 'showResetPasswordForm'])
        ->name('ResetPasswordShow');

    Route::post('/reset', [ResetPasswordController::class, 'submitResetPasswordForm'])
        ->name('ResetPasswordSubmit');
});
