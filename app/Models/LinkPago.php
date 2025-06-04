<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkPago extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'link_pagos';

    // Campos que pueden ser asignados en masa
    protected $fillable = [
        'cliente',
        'estatus',
        'titulo',
        'descripcion',
        'monto',
    ];

}
