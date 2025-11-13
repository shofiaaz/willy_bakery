<?php

use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PurchaserOrderController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\SaleController;
use App\Http\Controllers\Owner\SupplierController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('owner')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('owner.login');
    Route::post('login', [AuthController::class, 'login'])->name('owner.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('owner.logout');

    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('owner.dashboard');
        Route::post('dashboard/filter', [DashboardController::class, 'filter'])->name('owner.dashboard.filter');
        Route::resource('suppliers', SupplierController::class, ['as' => 'owner']);
        Route::resource('purchases', PurchaserOrderController::class, ['as' => 'owner']);
        Route::resource('sales', SaleController::class, ['as' => 'owner']);
        Route::get('reports', [ReportController::class, 'index'])->name('owner.reports.index');
        Route::get('reports/pdf/{type}', [ReportController::class, 'exportPdf'])->name('owner.reports.pdf');
        Route::get('reports/excel/{type}', [ReportController::class, 'exportExcel'])->name('owner.reports.excel');
    });

});
