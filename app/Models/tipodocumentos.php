<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumentos extends Model
{
    use HasFactory;

    protected $table = "tipo_documentos";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'tipo',
        'nombre',
        'img_portada',
        'img_reverso',
    ];

}
