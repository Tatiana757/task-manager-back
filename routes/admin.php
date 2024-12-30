<?php

use \App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::middleware("guest.admin:admin")->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login_process', [AuthController::class, 'login'])->name('login_process');
});

Route::middleware("auth:admin")->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('tasks', TaskController::class);
});