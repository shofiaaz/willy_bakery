<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supplier extends Authenticatable
{
    use Notifiable;

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
