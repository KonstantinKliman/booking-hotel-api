<?php

use App\Http\Controllers\Api\v1\HotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('hotel')->middleware(['auth:sanctum','verified-email'])->group(function () {
    Route::post('/', [HotelController::class, 'create'])->middleware('owner-role');
    Route::post('/{id}/image', [HotelController::class, 'addImage'])->middleware('owner-role');
    Route::delete('/{hotelId}/image/{imageId}', [HotelController::class, 'deleteImage'])->middleware('owner-role');
    Route::get('/{id}', [HotelController::class, 'getById']);
    Route::patch('/{id}', [HotelController::class, 'update'])->middleware('owner-role');
    Route::delete('/{id}', [HotelController::class, 'delete'])->middleware('owner-role');
});

Route::get('/hotels', [HotelController::class, 'list'])->middleware('auth:sanctum','verified-email');
