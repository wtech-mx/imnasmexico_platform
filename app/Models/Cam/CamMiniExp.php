<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamMiniExp extends Model
{
    use HasFactory;
    protected $table = 'cam_mini_exp';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'celular',
        'acta',
        'curp',
        'ine',
        'comprobante',
        'id_cliente',
        'id_usuario',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
