<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamPagosEmision extends Model
{
    use HasFactory;
    protected $table = 'cam_pagos_emision';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_estandar',
        'id_cliente',
        'id_usuario',
        'nombre',
        'estandar',
        'comprobante_pago',
        'cantidad_total',

    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }

    public function Estandar(){
        return $this->belongsTo(CamEstandares::class, 'id_estandar');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
