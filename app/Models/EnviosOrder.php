<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnviosOrder extends Model
{
    use HasFactory;
    protected $table = "enviosorder";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_order',
        'id_user',
        'foto_perfil',
        'estatus',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Orders()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }

}
