<?php

use App\Http\Controllers\Api\v1\RoomController;
use Illuminate\Support\Facades\Route;

Route::prefix('room')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [RoomController::class, 'create'])->middleware('owner-role');
    Route::get('/{id}', [RoomController::class, 'getById']);
    Route::patch('/{id}', [RoomController::class, 'update'])->middleware('owner-role');
    Route::delete('/{id}', [RoomController::class, 'delete'])->middleware('owner-role');
    Route::post('/{id}/image', [RoomController::class, 'addImage'])->middleware('owner-role');
    Route::delete('/{roomId}/image/{imageId}', [RoomController::class, 'deleteImage'])->middleware('owner-role');
});
