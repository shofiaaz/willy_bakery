<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProfile extends Model
{
    protected $primaryKey = 'profile_id';
    public $timestamps = false;
    protected $fillable = ['supplier_id', 'contact_person', 'company_type', 'notes'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
