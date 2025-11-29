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
        // Fetch recent sales data
        $salesData = \App\Models\Sale::with('product')
            ->select('sale_date', 'product_id', DB::raw('SUM(quantity) as quantity'))
            ->groupBy('sale_date', 'product_id')
            ->orderBy('sale_date')
            ->get();



        // Also load data for the other tabs
        $materials = \App\Models\RawMaterial::select('material_name', 'stock', 'unit', 'cost_per_unit')->get();
        $products = \App\Models\Product::select('product_name', 'stock', 'price')->get();
        $sales = \App\Models\Sale::with(['product', 'customer'])
            ->select('sale_id', 'product_id', 'customer_id', 'quantity', 'total', 'sale_date')
            ->latest()->take(20)->get();
        $purchases = \App\Models\PurchaserOrder::with('supplier')
            ->select('order_id', 'supplier_id', 'order_date', 'total_price', 'status')
            ->latest()->take(20)->get();

        $chartData = \App\Models\Sale::select(
            DB::raw('DATE_FORMAT(sale_date, "%Y-%m") as month'),
            DB::raw('SUM(total) as total_sales')
        )->groupBy('month')->orderBy('month')->get();

        $chartLabels = $chartData->pluck('month');
        $chartValues = $chartData->pluck('total_sales');

        // If no sales data
        if ($salesData->isEmpty()) {
            $message = "Belum ada data penjualan untuk melakukan forecasting.";
            return view('owner.reports.index', compact(
                'materials', 'products', 'sales', 'purchases',
                'chartLabels', 'chartValues', 'message'
            ))->with('activeTab', 'forecast');
        }

        // Save CSV
        $csvPath = storage_path('app/sales_data.csv');
        $csvFile = fopen($csvPath, 'w');
        fputcsv($csvFile, ['sale_date', 'product_name', 'quantity']);
        foreach ($salesData as $row) {
            fputcsv($csvFile, [
                $row->sale_date,
                $row->product->product_name ?? 'Unknown',
                $row->quantity ?? 0
            ]);
        }

        fclose($csvFile);

        // Run Python
        $pythonPath = 'C:\\laragon\\www\\willy_bakery\\.venv\\Scripts\\python.exe';
        $scriptPath = base_path('forecasting/sarima_forecast.py');

        $process = new \Symfony\Component\Process\Process([$pythonPath, $scriptPath, $csvPath]);
        $process->run();

        if (!$process->isSuccessful()) {
            $error = $process->getErrorOutput() ?: $process->getOutput();
            $message = "Gagal menjalankan forecasting: " . $error;
            return view('owner.reports.index', compact(
                'materials', 'products', 'sales', 'purchases',
                'chartLabels', 'chartValues', 'message'
            ))->with('activeTab', 'forecast');
        }

        $result = json_decode($process->getOutput(), true);

        if (isset($result['error'])) {
            $message = "Error: " . $result['error'];
            return view('owner.reports.index', compact(
                'materials', 'products', 'sales', 'purchases',
                'chartLabels', 'chartValues', 'message'
            ))->with('activeTab', 'forecast');
        }

        $forecastDates = [];
        $forecastValues = [];
        $productForecasts = [];
        $materialsForecast = [];
        $recommendedStock = 0;

        if (($result['type'] ?? '') === 'multi') {
            foreach ($result['forecasts'] as $product => $data) {
                $productForecasts[$product] = [
                    'dates' => $data['dates'],
                    'values' => $data['values'],
                    'avg' => collect($data['values'])->avg()
                ];
            }

            // Use first product’s data for the chart
            if (!empty($productForecasts)) {
                $firstProduct = array_key_first($productForecasts);
                $forecastDates = $productForecasts[$firstProduct]['dates'];
                $forecastValues = $productForecasts[$firstProduct]['values'];
            }

            $materialsForecast = $result['materials'] ?? [];
            $recommendedStock = ceil(
                collect($productForecasts)->pluck('avg')->sum() * 1.1
            );
        } else {
            $forecastDates = $result['dates'] ?? [];
            $forecastValues = $result['values'] ?? [];
            $productForecasts = [];
            $materialsForecast = $result['materials'] ?? [];
            $recommendedStock = ceil(collect($forecastValues)->avg() * 1.2);
        }
        return view('owner.reports.index', compact(
            'materials', 'products', 'sales', 'purchases',
            'chartLabels', 'chartValues',
            'forecastDates', 'forecastValues',
            'recommendedStock', 'productForecasts', 'materialsForecast'
        ))->with('activeTab', 'forecast');


    }


}
