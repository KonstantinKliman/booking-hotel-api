<?php

use App\Http\Controllers\Api\v1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [ProfileController::class, 'create']);
    Route::get('/{id}', [ProfileController::class, 'get']);
    Route::patch('/{id}', [ProfileController::class, 'update']);
    Route::delete('/{id}', [ProfileController::class, 'delete']);
});
