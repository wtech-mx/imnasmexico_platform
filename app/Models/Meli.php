<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meli extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'meli';

    // Campos que pueden ser asignados en masa
    protected $fillable = [
        'app_id',
        'client_secret',
        'link_renovacion_token',
        'accesstoken',
        'autorizacion',
        'sellerId',
        'user_id',
    ];
}
