<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForecastResult extends Model
{
    protected $table = 'forecast_results';
    protected $primaryKey = 'forecast_id';
    protected $fillable = ['product_id', 'forecast_date', 'predicted_demand', 'model_used'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
