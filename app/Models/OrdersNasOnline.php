<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersNasOnline extends Model
{
    use HasFactory;
    protected $table = "orders_nas_online";
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
        'num_kit',
        'kit',
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
