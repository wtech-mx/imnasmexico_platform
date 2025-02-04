<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersCosmicaOnline extends Model
{
    use HasFactory;
    protected $table = "orders_cosmica_online";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_order',
        'id_producto',
        'nombre',
        'cantidad',
        'precio',
        'estatus',
        'escaneados',
    ];

    public function Order()
    {
        return $this->belongsTo(OrdersCosmica::class, 'id_order');
    }

    public function Producto()
    {
        return $this->belongsTo(Products::class, 'id_producto');
    }
}
