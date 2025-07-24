<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;
    protected $table = 'user_sessions';
    protected $fillable = ['user_id','ip_address','user_agent','login_at','logout_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
