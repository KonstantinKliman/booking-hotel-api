<?php

use App\Http\Controllers\Api\v1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')->group(function () {
    Route::post('/create', [ProfileController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{id}', [ProfileController::class, 'show'])->middleware('auth:sanctum');
    Route::put('/{id}', [ProfileController::class, 'update'])->middleware('auth:sanctum');
});
