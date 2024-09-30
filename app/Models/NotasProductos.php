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

    public function Admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function ProductosNotasId()
    {
        return $this->hasMany(ProductosNotasId::class, 'id_notas_productos');
    }
}
