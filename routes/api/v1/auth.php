<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\EmailVerificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/{token}/{email}', [EmailVerificationController::class, 'verifyEmail']);
    Route::post('/resend_email_verification_link', [EmailVerificationController::class, 'resendVerificationLink']);
});
