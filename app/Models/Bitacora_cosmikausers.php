<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora_cosmikausers extends Model
{
    use HasFactory;

    protected $table = "bitacora_cosmikausers";

    protected $primarykey = "id";

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'membresia',
        'puntos_acomulados',
        'membresia_inicio',
        'membresia_fin',
        'meses_acomulados',
        'consumido_totalmes',
    ];
}
