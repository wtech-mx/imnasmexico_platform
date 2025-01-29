<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'categoria',
        'subcategoria',
        'descripcion',
        'precio_rebajado',
        'precio_normal',
        'imagenes',
        'stock',
        'stock_nas',
        'stock_cosmica',
        'laboratorio',
        'sku',
        'slug',
        'fecha',
    ];

    public function ProductosBundleId()
    {
        return $this->hasMany(ProductosBundleId::class, 'id_bundle_productos');
    }

    public function getNombreAttribute($value)
    {
        return trim($value);
    }

}
