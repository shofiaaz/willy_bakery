<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_name', 'email', 'phone', 'address'];
    public $timestamps = true;

    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
