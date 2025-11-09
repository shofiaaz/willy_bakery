<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaserOrder extends Model
{
    protected $primaryKey = 'order_id';
    protected $fillable = ['supplier_id', 'user_id', 'order_date', 'status', 'total_price'];
    public $timestamps = true;

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaserOrderItem::class, 'order_id');
    }
}
