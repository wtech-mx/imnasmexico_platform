<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamContrato extends Model
{
    use HasFactory;
    protected $table = 'cam_contrato';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'nombre',
        'dato_general',
        'rfc',
        'identificacion_ofi',
        'domicilio',
        'fecha',
        'firma',
    ];

    public function Nota(){
        return $this->belongsTo(Cam\CamNotas::class, 'id_nota');
    }
}
