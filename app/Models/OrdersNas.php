<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersNas extends Model
{
    use HasFactory;
    protected $table = "orders_nas";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'num_order',
        'id_usuario',
        'pago',
        'forma_pago',
        'estatus',
        'fecha',
        'code',
        'external_reference',
        'guia_doc',
        'fecha_preparacion',
        'fecha_preparado',
        'fecha_envio',
        'estatus_bodega',
        'forma_envio',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
