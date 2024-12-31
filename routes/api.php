<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['api.auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('tasks', TaskController::class);

        Route::get('/users', [UserController::class, 'getUsers']);

        Route::get('/user/profile', [UserController::class, 'getCurrentUser']);
    });
});
