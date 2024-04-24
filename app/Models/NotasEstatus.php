<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasEstatus extends Model
{
    use HasFactory;
    protected $table = 'notasestatus';

    protected $fillable = [
        'fecha',
        'time',
        'num_portafolio',
        'tipo',
        'tipo_modalidad',
        'tipo_alumno',
        'nombre_centro',
        'nombre_persona',
        'celular',
        'email',
        'estatus',
        'subida_portafolio',
        'evaluador',
    ];

}
