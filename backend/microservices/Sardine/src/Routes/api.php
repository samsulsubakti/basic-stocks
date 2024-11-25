<?php

use DolphinMicroservice\Http\Middleware\DolphinMiddleware;
use Illuminate\Support\Facades\Route;
use SardineMicroservice\Http\Controllers\Api\V1\ProfileController;

Route::prefix('api/v1/me')->group(function () {
    Route::post('/change-avatar', [ProfileController::class, 'store'])->middleware(DolphinMiddleware::class);
});
