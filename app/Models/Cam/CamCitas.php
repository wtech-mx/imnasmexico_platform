<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamCitas extends Model
{
    use HasFactory;
    protected $table = 'cam_citas';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'evaluacion_ec0076',
        'id_usuario_ec',
        'evaluacion_afines',
        'id_usuario_afin',
        'refuerzo_conocimiento',
        'id_usuario_cono',
        'refuerzo_formatos',
        'id_usuario_form',
        'coaching_empresarial',
        'id_usuario_empr',
        'carpeta_cam',
        'id_usuario_carpeta',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
}
