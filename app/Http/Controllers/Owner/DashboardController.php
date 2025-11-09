<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\PurchaserOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        return $this->generateDashboard($startDate, $endDate);
    }

    public function filter(Request $request)
    {
        $request->validate([
            'filter_type' => 'required|string',
        ]);

        if ($request->filter_type === '7_days') {
            $startDate = Carbon::now()->subDays(6)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } elseif ($request->filter_type === '30_days') {
            $startDate = Carbon::now()->subDays(29)->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } else {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
        }

        return $this->generateDashboard($startDate, $endDate);
    }

    private function generateDashboard($startDate, $endDate)
    {
        $totalSales = Sale::whereBetween('created_at', [$startDate, $endDate])->sum('total');
        $totalSuppliers = Supplier::count();
        $totalPurchases = PurchaserOrder::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');

        $salesChart = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_sales'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')->orderBy('date', 'ASC')->get();

        $purchaseChart = PurchaserOrder::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total_purchase'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')->orderBy('date', 'ASC')->get();

        return view('owner.dashboard', [
            'totalSales' => $totalSales,
            'totalSuppliers' => $totalSuppliers,
            'totalPurchases' => $totalPurchases,
            'salesDates' => $salesChart->pluck('date'),
            'salesTotals' => $salesChart->pluck('total_sales'),
            'purchaseDates' => $purchaseChart->pluck('date'),
            'purchaseTotals' => $purchaseChart->pluck('total_purchase'),
            'startDate' => $startDate->format('Y-m-d'),
            'endDate' => $endDate->format('Y-m-d'),
        ]);
    }
}
