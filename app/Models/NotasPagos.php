<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasPagos extends Model
{
    use HasFactory;
    protected $table = 'notas_pagos';

    protected $fillable = [
        'id_nota',
        'monto',
        'metodo_pago',
    ];
    
    public function Nota()
    {
        return $this->belongsTo(NotasCursos::class, 'id_nota');
    }
}
