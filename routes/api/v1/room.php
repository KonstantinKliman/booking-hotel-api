<?php

use App\Http\Controllers\Api\v1\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('rooms')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [RoomController::class, 'create'])->middleware(['owner-role', 'check-hotel-ownership']);
    Route::get('/{roomId}', [RoomController::class, 'getById']);
    Route::patch('/{roomId}', [RoomController::class, 'update'])->middleware(['owner-role', 'check-room-ownership']);
    Route::delete('/{roomId}', [RoomController::class, 'delete'])->middleware(['owner-role', 'check-room-ownership']);
    Route::post('/{roomId}/images', [RoomController::class, 'addImage'])->middleware(['owner-role', 'check-room-ownership']);
    Route::delete('/{roomId}/images/{imageId}', [RoomController::class, 'deleteImage'])->middleware(['owner-role', 'check-room-ownership']);
});
