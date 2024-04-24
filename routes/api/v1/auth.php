<?php

use App\Http\Controllers\Api\v1\EmailVerificationController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/{token}/{email}', [EmailVerificationController::class, 'verifyEmail']);
    Route::post('/resend_email_verification_link', [EmailVerificationController::class, 'resendVerificationLink']);
});
