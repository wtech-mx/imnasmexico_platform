<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasProductos extends Model
{
    use HasFactory;
    protected $table = 'notas_productos';

    protected $fillable = [
        'id_usuario',
        'id_admin_venta',
        'producto',
        'id_product_woo',
        'price',
        'permalink',
        'fecha',
        'total',
        'restante',
        'nota',
        'metodo_pago2',
        'monto',
        'monto2',
        'foto_pago2',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function Vendido()
    {
        return $this->belongsTo(User::class, 'id_admin_venta');
    }

    public function Admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function ProductosNotasId()
    {
        return $this->hasMany(ProductosNotasId::class, 'id_notas_productos');
    }

    public function Kit()
    {
        return $this->belongsTo(Products::class, 'id_kit');
    }
    public function Kit2()
    {
        return $this->belongsTo(Products::class, 'id_kit2');
    }
    public function Kit3()
    {
        return $this->belongsTo(Products::class, 'id_kit3');
    }
    public function Kit4()
    {
        return $this->belongsTo(Products::class, 'id_kit4');
    }
    public function Kit5()
    {
        return $this->belongsTo(Products::class, 'id_kit5');
    }
    public function Kit6()
    {
        return $this->belongsTo(Products::class, 'id_kit6');
    }
}
