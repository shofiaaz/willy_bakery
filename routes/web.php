<?php

use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\DashboardController;

Route::prefix('owner')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('owner.login');
    Route::post('login', [AuthController::class, 'login'])->name('owner.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('owner.logout');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
        Route::post('dashboard/filter', [DashboardController::class, 'filter'])->name('owner.dashboard.filter');
    });

});
