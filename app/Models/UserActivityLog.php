<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    protected $primaryKey = 'log_id';
    public $timestamps = false;
    protected $fillable = ['user_id', 'action', 'timestamp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
