<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionesBancarias extends Model
{
    use HasFactory;

    protected $table = 'transacciones_bancarias';

    protected $fillable = [
        'tipo',
        'id_empresa',
    ];


}
