<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamPagosRenovacion extends Model
{
    use HasFactory;
    protected $table = 'cam_pagos_renovacion';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_cliente',
        'id_usuario',
        'comprobante_pago',
        'cantidad_total',
        'fecha',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
