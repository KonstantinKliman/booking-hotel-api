<?php

use App\Http\Controllers\Api\v1\BookingController;
use Illuminate\Support\Facades\Route;

Route::prefix('bookings')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [BookingController::class, 'create'])->middleware('customer-role');
    Route::get('/', [BookingController::class, 'list']);
    Route::get('/{bookingId}', [BookingController::class, 'getById'])->middleware('check-booking-ownership');
    Route::patch('/{bookingId}', [BookingController::class, 'update']);
    Route::delete('/{bookingId}', [BookingController::class, 'delete']);
});
