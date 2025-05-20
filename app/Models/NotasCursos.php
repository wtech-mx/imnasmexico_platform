<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasCursos extends Model
{
    use HasFactory;
    protected $table = 'notas_curso';

    protected $fillable = [
        'id_usuario',
        'fecha',
        'total',
        'restante',
        'nota',
        'paquete',
        'subtotal',
        'descuento',
        'paquete',
        'factura',
        'total_iva',
        'situacion_fiscal',
        'razon_social',
        'rfc',
        'cfdi',
        'correo',
        'telefono',
        'direccion_factura',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function NotasPagos()
    {
        return $this->hasOne('App\Models\NotasPagos', 'id_nota', 'id');
    }

    public function Order()
    {
        return $this->belongsTo(Orders::class, 'paquete');
    }

    public function Factura()
    {
        return $this->hasOne(Factura::class, 'id_notas_cursos');
    }

    public function FacturaOrders()
    {
        return $this->hasOne('App\Models\Factura', 'id_orders', 'paquete');
    }
}
