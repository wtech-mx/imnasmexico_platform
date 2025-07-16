<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Bancos extends Model
{
    use HasFactory;

    protected $table = 'bancos';

    protected $fillable = [
        'nombre_beneficiario',
        'nombre_banco',
        'cuenta_bancaria',
        'clabe',
        'saldo',
        'saldo',
        'tipo',
    ];

}
