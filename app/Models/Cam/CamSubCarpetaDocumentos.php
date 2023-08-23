<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamSubCarpetaDocumentos extends Model
{
    use HasFactory;
    protected $table = 'cam_subcarpeta_documentos';
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'subcategoria',
        'id_carpdoc',
        'id_usuario',
    ];

    public function Carpeta(){
        return $this->belongsTo(CamCarpetaDocumentos::class, 'id_carpdoc');
    }

}
