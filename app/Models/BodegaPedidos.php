<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodegaPedidos extends Model
{
    use HasFactory;
    protected $table = "bodega_pedidos";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'fecha_pedido',
        'fecha_aprovado',
        'fecha_enviado',
        'fecha_recibido',
        'comentario',
        'estatus',
        'firma',
        'id_user',
        'fecha_aprovado_lab',
        'estatus_lab',
    ];
}
