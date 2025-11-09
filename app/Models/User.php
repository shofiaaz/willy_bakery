<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'role', 'email', 'phone'];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class, 'user_id');
    }
}
