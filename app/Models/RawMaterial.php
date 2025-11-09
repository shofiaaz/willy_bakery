<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $primaryKey = 'material_id';
    protected $fillable = ['material_name', 'stock', 'unit', 'cost_per_unit'];
    public $timestamps = true;

    public function usages()
    {
        return $this->hasMany(ProductUsage::class, 'material_id');
    }

    public function recipes()
    {
        return $this->hasMany(ProductRecipe::class, 'material_id');
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'material_id');
    }
}
