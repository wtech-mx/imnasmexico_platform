<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodegaPedidosProductosCosmica extends Model
{
    use HasFactory;
    protected $table = 'bodega_pedidos_productos_cosmica';
    protected $primarykey = "id";

    protected $fillable = [
        'id_pedido',
        'id_producto',
        'stock_anterior',
        'cantidad_pedido',
        'cantidad_recibido',
        'cantidad_restante',
        'cantidad_liquidado',
        'fecha_recibido',
        'fecha_liquidado',
    ];

    public function BodegaPedidosCosmica(){
        return $this->belongsTo(BodegaPedidosCosmica::class, 'id_pedido');
    }

    public function Products(){
        return $this->belongsTo(Products::class, 'id_producto');
    }
}
