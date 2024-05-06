<?php

use App\Http\Controllers\Api\v1\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('booking')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [BookingController::class, 'create'])->middleware('customer-role');
    Route::get('/{bookingId}', [BookingController::class, 'getById'])->middleware('check-booking-ownership');
    Route::patch('/{bookingId}', [BookingController::class, 'update']);
    Route::delete('/{bookingId}', [BookingController::class, 'delete']);
});

Route::get('bookings', [BookingController::class, 'list'])->middleware('auth:sanctum');
