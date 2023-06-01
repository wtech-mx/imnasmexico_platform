<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetaDocumentosEstandares extends Model
{
    use HasFactory;
    protected $table = "carpeta_documentos_estandares";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'ine',
        'id_carpeta',
        'nombre',
    ];
}
