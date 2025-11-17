<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\DailyProduction;
use App\Models\ProductUsage;
use App\Models\RawMaterial;
use App\Models\InventoryLog;
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
        $startTimestamp = $startDate->copy()->startOfDay();
        $endTimestamp   = $endDate->copy()->endOfDay();

        // ---------------------------
        // KPI 1 — Production totals
        // ---------------------------
        $totalProductionBatches = DailyProduction::whereBetween(
            'production_date',
            [$startDate->toDateString(), $endDate->toDateString()]
        )->sum('quantity_produced');

        // Previous period
        $days = $startDate->diffInDays($endDate) + 1;

        $prevStart = $startDate->copy()->subDays($days);
        $prevEnd   = $startDate->copy()->subDay();

        $prevProduction = DailyProduction::whereBetween(
            'production_date',
            [$prevStart->toDateString(), $prevEnd->toDateString()]
        )->sum('quantity_produced');

        $productionGrowth = $prevProduction > 0
            ? round((($totalProductionBatches - $prevProduction) / $prevProduction) * 100)
            : 100;


        // ---------------------------
        // KPI 2 — Raw material usage
        // ---------------------------
        $usedRawMaterials = ProductUsage::whereBetween(
            'created_at',
            [$startTimestamp, $endTimestamp]
        )->sum('quantity_used');

        $prevUsedRawMaterials = ProductUsage::whereBetween(
            'created_at',
            [$prevStart->copy()->startOfDay(), $prevEnd->copy()->endOfDay()]
        )->sum('quantity_used');

        $materialUsageChange = $prevUsedRawMaterials > 0
            ? round((($usedRawMaterials - $prevUsedRawMaterials) / $prevUsedRawMaterials) * 100)
            : 100;


        // ---------------------------
        // KPI 3 — Low stock
        // ---------------------------
        $lowStockCount = RawMaterial::where('stock', '<', 50)->count();


        // ---------------------------
        // CHART 1 — Production graph
        // ---------------------------
        $productionChart = DailyProduction::selectRaw('DATE(production_date) as date, SUM(quantity_produced) as total')
            ->whereBetween('production_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();


        // ---------------------------
        // CHART 2 — Material usage
        // ---------------------------
        $materialChart = ProductUsage::selectRaw('DATE(created_at) as date, SUM(quantity_used) as total')
            ->whereBetween('created_at', [$startTimestamp, $endTimestamp])
            ->groupBy('date')
            ->orderBy('date')
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
