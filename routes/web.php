<?php
use App\Http\Controllers\Produksi\ProduksiAuthController;
use App\Http\Controllers\Produksi\ProduksiDashboardController;
use App\Http\Controllers\Produksi\ProduksiProductController;
use App\Http\Controllers\Produksi\ProduksiProductionController;
use App\Http\Controllers\Produksi\ProduksiSupplyController;
use App\Http\Controllers\Produksi\ProduksiRecipeController;
use App\Http\Controllers\Supplier\SupplierAuthController;
use App\Http\Controllers\Supplier\SupplierDashboardController;
use App\Http\Controllers\Supplier\SupplierPurchaseController;
use App\Http\Controllers\Owner\AuthController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PurchaserOrderController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\ProductController;
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
        Route::get('stock', [ProductController::class, 'index'])->name('stock.index');
        Route::get('stock/{product}', [ProductController::class, 'show'])->name('stock.show');


        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/forecast', [ReportController::class, 'forecasting'])->name('reports.forecast');
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
        Route::resource('recipe', ProduksiRecipeController::class);


    });
});


// ======================
// SUPPLIER ROUTES
// ======================
Route::prefix('supplier')->name('supplier.')->group(function () {

    Route::get('/login', [App\Http\Controllers\Supplier\SupplierAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Supplier\SupplierAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [App\Http\Controllers\Supplier\SupplierAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:supplier')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Supplier\SupplierDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/filter', [App\Http\Controllers\Supplier\SupplierDashboardController::class, 'filter'])->name('dashboard.filter');
        Route::resource('/purchases', App\Http\Controllers\Supplier\SupplierPurchaseController::class);
        Route::get('purchases', [SupplierPurchaseController::class, 'index'])->name('purchases.index');
        Route::get('purchases/{id}/edit', [SupplierPurchaseController::class, 'edit'])->name('purchases.edit');
        Route::put('purchases/{id}', [SupplierPurchaseController::class, 'update'])->name('purchases.update');
    });
});






