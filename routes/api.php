<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/v1/auth.php';
    require __DIR__ . '/api/v1/user.php';
    require __DIR__ . '/api/v1/profile.php';
    require __DIR__ . '/api/v1/hotel.php';
    require __DIR__ . '/api/v1/room.php';
    require __DIR__ . '/api/v1/booking.php';
});
