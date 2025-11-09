<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name', 'description', 'stock', 'price'];
    public $timestamps = true;

    public function usages()
    {
        return $this->hasMany(ProductUsage::class, 'product_id');
    }

    public function recipes()
    {
        return $this->hasMany(ProductRecipe::class, 'product_id');
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'product_id');
    }
}
