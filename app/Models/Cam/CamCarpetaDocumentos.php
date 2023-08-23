<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamCarpetaDocumentos extends Model
{
    use HasFactory;
    protected $table = 'cam_carpeta_documentos';
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'categoria',
        'id_usuario',
    ];

}
