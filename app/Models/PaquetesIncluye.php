<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaquetesIncluye extends Model
{
    use HasFactory;
    protected $table = "paquetes_incluyen";
    protected $primarykey = "id";

    protected $fillable = [
        'nombre_curso',
        'num_paquete',
    ];
}
