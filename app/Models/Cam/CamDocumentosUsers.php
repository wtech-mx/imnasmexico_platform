<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamDocumentosUsers extends Model
{
    use HasFactory;
    protected $table = 'cam_citas';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'acuerdo_confidencialidad',
        'logo',
        'comprobante_domicilio',
        'contrato_individual',
        'curriculum',
        'ine',
        'curp',
        'acta_nacimiento',
        'estandar_76',
        'foto',
        'id_usuario_foto',
        'contrato_general',
        'id_usuario_con',
        'solicitud_acreditacion',
        'id_usuario_sol',
        'carta_compromiso',
        'id_usuario_com',
        'carta_responsabilidad',
        'id_usuario_res',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
}
