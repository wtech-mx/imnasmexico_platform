<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvasesProductos extends Model
{
    use HasFactory;
    protected $table = "envases_prosuctos";
    protected $primarykey = "id";

    protected $fillable = [
        'id_envase',
        'id_producto',
    ];

    public function Envases(){
        return $this->belongsTo(Envases::class, 'id_envase');
    }

    public function Product(){
        return $this->belongsTo(Products::class, 'id_producto');
    }
}
