<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyProduction extends Model
{
    protected $primaryKey = 'production_id';
    protected $fillable = ['product_id', 'production_date', 'quantity_produced', 'status'];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
