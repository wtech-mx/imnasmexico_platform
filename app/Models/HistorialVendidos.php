<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialVendidos extends Model
{
    use HasFactory;
    protected $table = 'historial_vendidos';
    protected $primarykey = "id";

    protected $fillable = [
        'id_producto',
        'stock_viejo',
        'cantidad_restado',
        'stock_actual',
        'id_cotizacion_nas',
        'id_cotizacion_cosmica',
        'id_venta_nas',
        'id_paradisus',
        'id_nas_online',
        'id_cosmica_online',
        'fecha',
    ];

    public function Products(){
        return $this->belongsTo(Products::class, 'id_producto');
    }
    public function NotasProductosCosmica(){
        return $this->belongsTo(NotasProductosCosmica::class, 'id_cotizacion_cosmica');
    }
    public function NotasProductos(){
        return $this->belongsTo(NotasProductos::class, 'id_cotizacion_nas');
    }
    public function NotasProductosVentas(){
        return $this->belongsTo(NotasProductos::class, 'id_venta_nas');
    }
}
