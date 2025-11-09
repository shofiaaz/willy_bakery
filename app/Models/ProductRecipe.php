<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRecipe extends Model
{
    protected $primaryKey = 'recipe_id';
    public $timestamps = false;
    protected $fillable = ['product_id', 'material_id', 'quantity_needed'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function material()
    {
        return $this->belongsTo(RawMaterial::class, 'material_id');
    }
}
