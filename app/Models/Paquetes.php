<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paquetes extends Model
{
    use HasFactory;
    protected $table = "paquetes";
    protected $primarykey = "id";

    protected $fillable = [
        'visible_1',
        'precio_1',
        'precio_rebajado_1',
        'precio_curso_1',
        'visible_2',
        'precio_2',
        'precio_rebajado_2',
        'precio_curso_2',
        'visible_3',
        'precio_3',
        'precio_rebajado_3',
        'precio_curso_3',
        'visible_4',
        'precio_4',
        'precio_rebajado_4',
        'precio_curso_4',
        'visible_5',
        'precio_5',
        'precio_rebajado_5',
        'precio_curso_5',
    ];
}
