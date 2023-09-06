<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaRecursos extends Model
{
    use HasFactory;
    protected $table = "carpeta_recursos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_carpeta',
        'nombre',
        'area',
        'sub_area',
    ];
}
