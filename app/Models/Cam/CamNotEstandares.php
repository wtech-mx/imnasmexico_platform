<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamNotEstandares extends Model
{
    use HasFactory;
    protected $table = 'cam_notestandares';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_estandar',
        'estatus',
        'evaluador',
        'id_usuario',
        'operables',
        'ya_contaba',
        'fecha_evaluar',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }

    public function Estandar(){
        return $this->belongsTo('App\Models\CarpetasEstandares'::class, 'id_estandar');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
