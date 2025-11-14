<?php
use App\Http\Controllers\Produksi\ProduksiAuthController;
use App\Http\Controllers\Produksi\ProduksiDashboardController;
use App\Http\Controllers\Produksi\ProduksiProductController;
use App\Http\Controllers\Produksi\ProduksiProductionController;
use App\Http\Controllers\Produksi\ProduksiSupplyController;
use App\Http\Controllers\Supplier\SupplierAuthController;
use App\Http\Controllers\Supplier\SupplierDashboardController;
use App\Http\Controllers\Supplier\SupplierPurchaseController;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PurchaserOrderController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\SaleController;
use App\Http\Controllers\Owner\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ======================
// OWNER ROUTES
// ======================
Route::prefix('owner')->name('owner.')->group(function () {

    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');

        Route::resource('suppliers', SupplierController::class);
        Route::resource('purchases', PurchaserOrderController::class);
        Route::resource('sales', SaleController::class);

        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/pdf/{type}', [ReportController::class, 'exportPdf'])->name('reports.pdf');
        Route::get('reports/excel/{type}', [ReportController::class, 'exportExcel'])->name('reports.excel');
    });

}); // ✅ Owner routes CLOSED properly


// ======================
// PRODUKSI ROUTES
// ======================
Route::prefix('produksi')->name('produksi.')->group(function () {

    Route::get('login', [ProduksiAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [ProduksiAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [ProduksiAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [ProduksiDashboardController::class, 'index'])->name('dashboard');
        Route::post('dashboard/filter', [ProduksiDashboardController::class, 'filter'])->name('dashboard.filter');

        Route::resource('supplies', ProduksiSupplyController::class);
        Route::resource('production', ProduksiProductionController::class);
        Route::resource('product', ProduksiProductController::class);
    });
});


// ======================
// SUPPLIER ROUTES
// ======================
Route::prefix('supplier')->name('supplier.')->group(function () {

    Route::get('login', [SupplierAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [SupplierAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [SupplierAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
        Route::resource('purchases', SupplierPurchaseController::class);
    });
});




