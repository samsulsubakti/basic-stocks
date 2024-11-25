<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Base\UserController;

Route::prefix("base")->group(function () {

  Route::prefix("users")->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
  });
});
