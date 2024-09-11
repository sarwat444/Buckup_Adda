<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\site\Instructor\{InstructorRequestController , InsteractorRegesterationController };
use App\Http\Controllers\Apis\site\Auth\users\{ForgetPasswordController, LoginController, NewPasswordController};

/** users auth routes */

Route::controller(LoginController::class)->prefix('users')->group(function () {
    Route::post('login', 'store')->name('users.login');
    Route::post('register', 'register')->name('users.register');
    Route::post('logout', 'destroy')->name('users.logout')->middleware('auth');
});


/** users reset password routes */
Route::controller(ForgetPasswordController::class)->prefix('users')->middleware('guest')->group(function () {
    Route::get('forget-password', 'create')->name('password.request');
    Route::post('forget-password', 'store')->name('password.email')->middleware('throttle:5,1');;
});

/** users new password routes */
Route::controller(NewPasswordController::class)->prefix('users')->middleware('guest')->group(function () {
    Route::get('reset-password/{token}', 'create')->name('password.reset');
    Route::post('reset-password', 'store')->name('password.update');
});


Route::controller(InstructorRequestController::class)->prefix('instractors')->middleware('auth:api')->group(function () {
    Route::post('send-request' , 'store')->name('send-request.store');
});

Route::controller(InsteractorRegesterationController::class)->prefix('instractorsrequests')->middleware('auth:api')->group(function () {
    Route::post('save-personal-information' , 'store');
    Route::post('save-bank-information' , 'savebankdetails');
});
