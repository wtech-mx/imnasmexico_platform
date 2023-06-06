<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{
    use HasFactory;
    protected $table = "votos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'votos',
        'foto_perfil',
        'facebook',
        'instagram',
        'tiktok',
        'foto_antes',
        'foto_despues',
        'estatus',
    ];

}
