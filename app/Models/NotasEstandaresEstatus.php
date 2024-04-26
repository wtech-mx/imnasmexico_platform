<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasEstandaresEstatus extends Model
{
    use HasFactory;
    protected $table = 'notasestandares_estatus';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_estandar',
        'estatus',
        'evaluador',
        'fecha_cedula',
        'fecha_portafolio',
        'fecha_lote',
        'fecha_dictamen',
        'fecha_certificacion',
    ];

    public function NotasEstatus(){
        return $this->belongsTo(NotasEstatus::class, 'id_nota');
    }

    public function Estandar(){
        return $this->belongsTo(CamEstandares::class, 'id_estandar');
    }

}
