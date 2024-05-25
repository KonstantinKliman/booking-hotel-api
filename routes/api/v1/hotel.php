<?php

use App\Http\Controllers\Api\v1\HotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('hotels')->middleware(['auth:sanctum','verified-email'])->group(function () {
    Route::post('/', [HotelController::class, 'create'])->middleware('owner-role');
    Route::get('/', [HotelController::class, 'list']);
    Route::get('/{hotelId}', [HotelController::class, 'getById']);
    Route::patch('/{hotelId}', [HotelController::class, 'update'])->middleware(['owner-role', 'check-hotel-ownership']);
    Route::delete('/{hotelId}', [HotelController::class, 'delete'])->middleware(['owner-role', 'check-hotel-ownership']);
    Route::post('/{hotelId}/image', [HotelController::class, 'addImage'])->middleware(['owner-role', 'check-hotel-ownership']);
    Route::delete('/{hotelId}/image/{imageId}', [HotelController::class, 'deleteImage'])->middleware(['owner-role', 'check-hotel-ownership']);

});
