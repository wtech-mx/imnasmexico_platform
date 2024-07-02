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
    ];

    public function Nota()
    {
        return $this->belongsTo(NotasProductos::class, 'id_notas_productos');
    }
}
