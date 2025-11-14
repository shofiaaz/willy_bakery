<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DailyProduction;
use App\Models\ProductUsage;
use App\Models\RawMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiDashboardController extends Controller
{
    public function index()
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
        // =======================
        // KPI 1 — Total production batches
        // =======================
        $totalProductionBatches = DailyProduction::whereBetween('production_date', [
                $startDate->toDateString(),
                $endDate->toDateString(),
            ])
            ->sum('quantity_produced');

        // LAST PERIOD for growth comparison
        $prevStart = (clone $startDate)->subDays($startDate->diffInDays($endDate) + 1);
        $prevEnd   = (clone $startDate)->subDay();

        $prevProduction = DailyProduction::whereBetween('production_date', [
                $prevStart->toDateString(),
                $prevEnd->toDateString(),
            ])
            ->sum('quantity_produced');

        $productionGrowth = $prevProduction > 0
            ? round((($totalProductionBatches - $prevProduction) / $prevProduction) * 100)
            : 100;

        // =======================
        // KPI 2 — Raw material usage
        // =======================
        $usedRawMaterials = ProductUsage::whereBetween('created_at', [$startDate, $endDate])
            ->sum('quantity_used');

        $prevUsedRawMaterials = ProductUsage::whereBetween('created_at', [$prevStart, $prevEnd])
            ->sum('quantity_used');

        $materialUsageChange = $prevUsedRawMaterials > 0
            ? round((($usedRawMaterials - $prevUsedRawMaterials) / $prevUsedRawMaterials) * 100)
            : 100;

        // =======================
        // KPI 3 — Low stock items
        // Define your stock threshold here (example: < 50 units)
        // =======================
        $lowStockCount = RawMaterial::where('stock', '<', 50)->count();

        // =======================
        // CHART 1 — Production volume graph
        // =======================
        $productionChart = DailyProduction::select(
                DB::raw('DATE(production_date) as date'),
                DB::raw('SUM(quantity_produced) as total')
            )
            ->whereBetween('production_date', [
                $startDate->toDateString(),
                $endDate->toDateString()
            ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // =======================
        // CHART 2 — Raw material usage graph
        // =======================
        $materialChart = ProductUsage::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(quantity_used) as total')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return view('produksi.dashboard', [
            'totalProductionBatches' => $totalProductionBatches,
            'productionGrowth'       => $productionGrowth,
            'usedRawMaterials'       => $usedRawMaterials,
            'materialUsageChange'    => $materialUsageChange,
            'lowStockCount'          => $lowStockCount,

            'productionDates'        => $productionChart->pluck('date'),
            'productionTotals'       => $productionChart->pluck('total'),
            'materialDates'          => $materialChart->pluck('date'),
            'materialTotals'         => $materialChart->pluck('total'),

            'startDate'              => $startDate->format('Y-m-d'),
            'endDate'                => $endDate->format('Y-m-d'),
        ]);
    }
}
