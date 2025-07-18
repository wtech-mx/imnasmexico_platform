<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CuentasBancarias extends Model
{
    use HasFactory;
    protected $table = 'cuentas_bancarias';

    protected $fillable = [
        'cuenta_bancaria',
        'id_proveedores',
        'nombre_beneficiario',
        'cuenta_bancaria',
        'nombre_banco',
        'cuenta_clabe',
    ];

    public function Proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedores');
    }


}
