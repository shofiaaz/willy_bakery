<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $primaryKey = 'log_id';
    public $timestamps = false;
    protected $fillable = ['product_id', 'material_id', 'type', 'quantity', 'timestamp'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function material()
    {
        return $this->belongsTo(RawMaterial::class, 'material_id');
    }
}
