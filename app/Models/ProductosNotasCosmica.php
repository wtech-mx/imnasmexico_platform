<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosNotasCosmica extends Model
{
    use HasFactory;
    protected $table = 'productos_notas_cosmica';

    protected $fillable = [
        'id_notas_productos',
        'id_producto',
        'producto',
        'price',
        'cantidad',
        'descuento',
        'total',
    ];

    public function Nota()
    {
        return $this->belongsTo(NotasProductosCosmica::class, 'id_notas_productos');
    }

    public function Productos()
    {
        return $this->belongsTo(Products::class, 'id_producto');
    }
}
