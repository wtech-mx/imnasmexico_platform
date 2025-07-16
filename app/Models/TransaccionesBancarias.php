<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaccionesBancarias extends Model
{
    use HasFactory;

    protected $table = 'transacciones_bancarias';

    protected $fillable = [
        'id_transaccion',
        'fechaOperacion',
        'institucionOrdenante',
        'institucionBeneficiaria',
        'claveRastreo',
        'monto',
        'nombreOrdenante',
        'tipoCuentaOrdenante',
        'cuentaOrdenante',
        'rfcCurpOrdenante',
        'nombreBeneficiario',
        'tipoCuentaBeneficiario',
        'cuentaBeneficiario',
        'nombreBeneficiario2',
        'tipoCuentaBeneficiario2',
        'cuentaBeneficiario2',
        'rfcCurpBeneficiario',
        'conceptoPago',
        'referenciaNumerica',
        'empresa',
        'tipoPago',
        'tsLiquidacion',
        'folioCo'
    ];



}
