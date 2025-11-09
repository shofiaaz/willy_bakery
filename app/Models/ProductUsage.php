<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUsage extends Model
{
    protected $primaryKey = 'usage_id';
    protected $fillable = ['product_id', 'material_id', 'quantity_used'];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function material()
    {
        return $this->belongsTo(RawMaterial::class, 'material_id');
    }
}
