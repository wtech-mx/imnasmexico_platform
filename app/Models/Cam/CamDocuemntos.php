<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamDocuemntos extends Model
{
    use HasFactory;
    protected $table = 'cam_documentos';
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'id_carpdoc',
        'id_subcarpdoc',
        'id_usuario',
    ];

    public function Carpeta(){
        return $this->belongsTo(CamCarpetaDocumentos::class, 'id_carpdoc');
    }

    public function subCarpeta(){
        return $this->belongsTo(CamSubCarpetaDocumentos::class, 'id_subcarpdoc');
    }
}
