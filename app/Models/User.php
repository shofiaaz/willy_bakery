<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
        'email',
        'phone',
    ];

    protected $hidden = [
        'password',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class, 'user_id');
    }
}
