<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosNotasId extends Model
{
    use HasFactory;
    protected $table = 'productos_notas_id';

    protected $fillable = [
        'id_notas_productos',
        'producto',
        'price',
        'cantidad',
        'descuento',
        'estatus',
        'num_kit',
        'id_producto',
        'escaneados',
        'kit',
    ];

    public function Nota()
    {
        return $this->belongsTo(NotasProductos::class, 'id_notas_productos');
    }

    public function Productos()
    {
        return $this->belongsTo(Products::class, 'id_producto');
    }

    public function ProductosRepo()
    {
        return $this->belongsTo(Products::class, 'id_reposicion_producto');
    }

    public function ProductoKit()
    {
        return $this->belongsTo(Products::class, 'num_kit');
    }
}
