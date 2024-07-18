<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCompras extends Model
{
    use HasFactory;
    protected $table = 'registro_compras';

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'ciudad',
        'monto',
        'distribucion',
        'sugerencia',
    ];
}
