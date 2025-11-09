<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\PurchaserOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Sale::sum('total');
        $totalSuppliers = Supplier::count();
        $totalPurchases = PurchaserOrder::sum('total_price');

        return view('owner.dashboard', compact('totalSales', 'totalSuppliers', 'totalPurchases'));
    }
}
