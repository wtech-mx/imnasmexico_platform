<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialStock extends Model
{
    use HasFactory;

    protected $table = "historial_stock";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_producto',
        'user',
        'precio_normal',
        'precio_rebajado',
        'sku',
        'stock',
        'stock_nas',
        'stock_cosmica',
        'laboratorio',
        'categoria',
        'subcategoria',
        'tipo_cambio',
        'stock_laboratorio',
        'stock_etiqueta',
    ];
    
    public function Products(){
        return $this->belongsTo(Products::class, 'id_producto');
    }
}
