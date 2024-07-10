<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroLlegada extends Model
{
    use HasFactory;
    protected $table = 'registro_llegada';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'ciudad',
        'conociste',
        'espectativa',
        'sugerencia',
    ];
}
