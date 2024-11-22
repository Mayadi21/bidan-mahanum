<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
// use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\Auth\ChangeEmailController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;


Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'request'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'email'])->name('password.email');

    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'update'])->name('password.update');
});


Route::middleware(['auth', 'notBanned'])->group(function () {
    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('password.change');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.modify');
    
    Route::get('/change-email', [ChangeEmailController::class, 'change'])->name('email.change');
    Route::post('/change-email', [ChangeEmailController::class, 'check'])->name('email.check');
    Route::post('/update-email', [ChangeEmailController::class, 'update'])->name('email.update');
});

