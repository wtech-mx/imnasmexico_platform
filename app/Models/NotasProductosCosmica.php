<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasProductosCosmica extends Model
{
    use HasFactory;
    protected $table = 'notas_productos_cosmica';

    protected $fillable = [
        'id_usuario',
        'id_admin',
        'tipo_nota',
        'envio',
        'fecha',
        'subtotal',
        'total',
        'dinero_recibido',
        'restante',
        'nota',
        'descuento',
        'cambio',
        'metodo_pago',
        'monto',
        'foto_pago',
        'metodo_pago2',
        'monto2',
        'foto_pago2',
        'nombre',
        'telefono',
        'factura',
        'situacion_fiscal',
        'razon_social',
        'rfc',
        'cfdi',
        'correo_fac',
        'telefono_fac',
        'direccion_fac',
        'folio',
        'estatus_cotizacion',
        'estadociudad',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function ProductosNotasId()
    {
        return $this->hasMany(ProductosNotasId::class, 'id_notas_productos');
    }
}
