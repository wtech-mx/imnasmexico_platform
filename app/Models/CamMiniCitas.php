<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamMiniCitas extends Model
{
    use HasFactory;
    protected $table = 'cam_mini_citas';
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
        'check1',
        'check2',
        'check3',
        'check4',
        'check5',
        'check6',
    ];

    public function CamMiniExp(){
        return $this->belongsTo(Cam\CamMiniExp::class, 'id_mini');
    }

    public function UserEC(){
        return $this->belongsTo(User::class, 'id_usuario_ec');
    }
    public function UserFin(){
        return $this->belongsTo(User::class, 'id_usuario_afin');
    }
    public function UserCon(){
        return $this->belongsTo(User::class, 'id_usuario_cono');
    }
    public function UserFor(){
        return $this->belongsTo(User::class, 'id_usuario_form');
    }
    public function UserEm(){
        return $this->belongsTo(User::class, 'id_usuario_empr');
    }
    public function UserCar(){
        return $this->belongsTo(User::class, 'id_usuario_carpeta');
    }
}
