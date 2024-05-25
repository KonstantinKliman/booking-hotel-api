<?php

use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/{userId}', [UserController::class, 'getById']);
    Route::patch('/{userId}', [UserController::class, 'update'])->middleware('check-user-edit-access');
});
