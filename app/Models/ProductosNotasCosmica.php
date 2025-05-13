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
        'asistencia',
        'confirmacion',
        'producto',
        'price',
        'cantidad',
        'escaneados',
        'descuento',
        'total',
        'estatus',
        'kit',
        'num_kit',
        'id_reposicion_producto',
        'id_reposicion_producto',
    ];

    public function Nota()
    {
        return $this->belongsTo(NotasProductosCosmica::class, 'id_notas_productos');
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
