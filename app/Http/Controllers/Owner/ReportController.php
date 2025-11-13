<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\Sale;
use App\Models\PurchaserOrder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $materials = RawMaterial::select('material_name', 'stock', 'unit', 'cost_per_unit')->get();
        $products = Product::select('product_name', 'stock', 'price')->get();

        $sales = Sale::with(['product', 'customer'])
            ->select('sale_id', 'product_id', 'customer_id', 'quantity', 'total', 'sale_date')
            ->latest()
            ->take(20)
            ->get();

        $purchases = PurchaserOrder::with('supplier')
            ->select('order_id', 'supplier_id', 'order_date', 'total_price', 'status')
            ->latest()
            ->take(20)
            ->get();

        $chartData = Sale::select(
            DB::raw('DATE_FORMAT(sale_date, "%Y-%m") as month'),
            DB::raw('SUM(total) as total_sales')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = $chartData->pluck('month');
        $chartValues = $chartData->pluck('total_sales');

        return view('owner.reports.index', compact(
            'materials',
            'products',
            'sales',
            'purchases',
            'chartLabels',
            'chartValues'
        ));
    }

    public function downloadPDF($type)
    {
        switch ($type) {
            case 'stock':
                $materials = RawMaterial::all();
                $products = Product::all();
                $pdf = Pdf::loadView('owner.reports.pdf.stock', compact('materials', 'products'));
                break;

            case 'sales':
                $sales = Sale::latest()->take(50)->get();
                $pdf = Pdf::loadView('owner.reports.pdf.sales', compact('sales'));
                break;

            case 'purchases':
                $purchases = PurchaserOrder::with('supplier')->get();
                $pdf = Pdf::loadView('owner.reports.pdf.purchases', compact('purchases'));
                break;

            default:
                abort(404);
        }

        return $pdf->download("laporan-{$type}.pdf");
    }

    public function downloadExcel($type)
    {
        $filename = "laporan-{$type}.xlsx";
        $exportData = [];

        switch ($type) {
            case 'stock':
                $exportData = [
                    'materials' => RawMaterial::all()->toArray(),
                    'products' => Product::all()->toArray(),
                ];
                break;

            case 'sales':
                $exportData = Sale::latest()->take(50)->get()->toArray();
                break;

            case 'purchases':
                $exportData = PurchaserOrder::with('supplier')->get()->toArray();
                break;
        }

        return Excel::download(new \App\Exports\GenericExport($exportData), $filename);
    }

    public function forecasting()
    {
        $message = "Modul forecasting (S-ARIMA) masih dalam pengembangan.";
        return view('owner.reports.forecast', compact('message'));
    }
}
