<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $primaryKey = 'profile_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'name', 'address', 'contact_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
