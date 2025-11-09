<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'price', 'total', 'sale_date'];
    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
