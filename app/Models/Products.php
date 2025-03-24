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
        'sku',
        'slug',
        'nombre',
        'stock_nas',
        'categoria',
        'laboratorio',
        'subcategoria',
        'stock',
        'stock_cosmica',
        'descripcion',
        'precio_rebajado',
        'precio_normal',
        'imagenes',
        'fecha_fin',
        'conteo_lab',
        'visibilidad_granel',
        'etiqueta_lateral',
        'etiqueta_tapa',
        'etiqueta_frente',
        'etiqueta_reversa',
        'estatus_lateral',
        'estatus_tapa',
        'estatus_frente',
        'estatus_reversa',
        'linea',
        'sublinea',
        'modo_empleo',
        'beneficios',
        'ingredientes',
        'precauciones',
        'favorito',
        'estatus',
        'id_categoria',
    ];

    public function ProductosBundleId()
    {
        return $this->hasMany(ProductosBundleId::class, 'id_bundle_productos');
    }

    public function getNombreAttribute($value)
    {
        return trim($value);
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'id_categoria');
    }

}
