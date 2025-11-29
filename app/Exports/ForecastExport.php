<?php

namespace App\Exports;

use App\Models\ForecastResult;
use Maatwebsite\Excel\Concerns\FromCollection;

class ForecastExport implements FromCollection
{
    public function collection()
    {
        return ForecastResult::select('product_id', 'forecast_date', 'predicted_demand', 'model_used')->get();
    }
}
