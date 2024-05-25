<?php

use App\Http\Controllers\Api\v1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profiles')->middleware(['auth:sanctum', 'verified-email'])->group(function () {
    Route::post('/', [ProfileController::class, 'create']);
    Route::get('/{profileId}', [ProfileController::class, 'get']);
    Route::patch('/{profileId}', [ProfileController::class, 'update'])->middleware('check-profile-edit-access');
    Route::delete('/{profileId}', [ProfileController::class, 'delete'])->middleware('check-profile-edit-access');;
});
