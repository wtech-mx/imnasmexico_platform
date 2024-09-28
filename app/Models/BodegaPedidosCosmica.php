<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodegaPedidosCosmica extends Model
{
    use HasFactory;
    protected $table = "bodega_pedidos_cosmica";
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
    ];
}
