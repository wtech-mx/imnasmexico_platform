<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CamNotas extends Model
{
    use HasFactory;
    protected $table = 'cam_notas';
    protected $primarykey = "id";

    protected $fillable = [
        'id_cliente',
        'tipo',
        'monto1',
        'monto2',
        'metodo_pago',
        'metodo_pago2',
        'nota',
        'nota2',
        'comprobante',
        'descuento',
        'id_usuario',
        'referencia',
    ];

    public function Cliente(){
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Video(){
        return $this->hasMany(CamVideosUser::class, 'id_nota', 'id');
    }

}
