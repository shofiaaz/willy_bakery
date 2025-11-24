<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaserOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierDashboardController extends Controller
{
    public function index()
    {
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        return $this->generateDashboard($startDate, $endDate);
    }

    public function filter(Request $request)
    {
        $request->validate(['filter_type' => 'required|string']);

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
        $supplier = Auth::guard('supplier')->user();
        if (!$supplier) {
            abort(403, 'Supplier not authenticated.');
        }

        $supplierId = $supplier->supplier_id;

        // 🧾 Get Purchases (10 latest)
        $purchases = PurchaserOrder::where('supplier_id', $supplierId)
            ->whereBetween('order_date', [$startDate, $endDate])
            ->orderByDesc('order_date')
            ->take(10)
            ->get();

        // 🚚 Generate Deliveries (derived from purchases)
        $deliveries = collect($purchases)->map(function ($order) {
            return (object) [
                'delivery_date' => $order->order_date,
                'order_number' => 'ORD-' . str_pad($order->order_id, 5, '0', STR_PAD_LEFT),
                'status' => match (strtolower($order->status)) {
                    'completed' => 'delivered',
                    'accepted' => 'in_transit',
                    'on delivery' => 'in_transit',
                    'finished' => 'delivered',
                    'pending' => 'processing',
                    default => 'processing',
                },
                'notes' => 'Pengiriman terkait pesanan #' . $order->order_id,
            ];
        });

        // ✅ Always pass both variables to the view
        return view('supplier.dashboard', [
            'purchases' => $purchases,
            'deliveries' => $deliveries,
        ]);
    }
}
