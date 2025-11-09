<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaserOrderItem extends Model
{
    protected $primaryKey = 'item_id';
    public $timestamps = false;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(PurchaserOrder::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
