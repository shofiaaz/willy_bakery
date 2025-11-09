<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';
    protected $fillable = ['supplier_name', 'email', 'phone', 'address'];
    public $timestamps = true;

    public function profile()
    {
        return $this->hasOne(SupplierProfile::class, 'supplier_id');
    }

    public function purchaserOrders()
    {
        return $this->hasMany(PurchaserOrder::class, 'supplier_id');
    }
}
