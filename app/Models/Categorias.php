<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $table = "categorias";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'linea',
        'fecha_inicio',
        'fecha_fin',
        'descuento',
        'estatus_descuento',
        'estatus_visibilidad',
        'color',
        'frase',
        'imagen',
        'portada',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'id_categoria');
    }

    public function products2()
    {
        return $this->hasMany(Products::class, 'id_categoria2');
    }

}
