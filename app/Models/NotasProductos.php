<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasProductos extends Model
{
    use HasFactory;
    protected $table = 'notas_productos';

    protected $fillable = [
        'id_usuario',
        'id_admin_venta',
        'producto',
        'id_product_woo',
        'price',
        'permalink',
        'fecha',
        'subtotal',
        'total',
        'restante',
        'fecha_aprobada',
        'nota',
        'metodo_pago',
        'metodo_pago2',
        'monto',
        'monto2',
        'foto_pago',
        'foto_pago2',
        'folio',
        'estatus_cotizacion',
        'tipo',
        'tipo_nota',
        'envio',
        'dinero_recibido',
        'nombre',
        'telefono',
        'cambio',
        'factura',
        'situacion_fiscal',
        'razon_social',
        'rfc',
        'cfdi',
        'correo_fac',
        'telefono_fac',
        'direccion_fac',
        'estadociudad',
        'doc_guia',
        'fecha_preparacion',
        'fecha_preparado',
        'fecha_envio',
        'fecha_entrega',
        'direccion_entrega',
        'comentario_rep',
        'id_kit',
        'id_kit2',
        'id_kit3',
        'id_kit4',
        'id_kit5',
        'id_kit6',
        'cantidad_kit',
        'cantidad_kit2',
        'cantidad_kit3',
        'cantidad_kit4',
        'cantidad_kit5',
        'cantidad_kit6',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function Vendido()
    {
        return $this->belongsTo(User::class, 'id_admin_venta');
    }

    public function Admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function ProductosNotasId()
    {
        return $this->hasMany(ProductosNotasId::class, 'id_notas_productos');
    }

    public function Kit()
    {
        return $this->belongsTo(Products::class, 'id_kit');
    }
    public function Kit2()
    {
        return $this->belongsTo(Products::class, 'id_kit2');
    }
    public function Kit3()
    {
        return $this->belongsTo(Products::class, 'id_kit3');
    }
    public function Kit4()
    {
        return $this->belongsTo(Products::class, 'id_kit4');
    }
    public function Kit5()
    {
        return $this->belongsTo(Products::class, 'id_kit5');
    }
    public function Kit6()
    {
        return $this->belongsTo(Products::class, 'id_kit6');
    }

    // public function factura()
    // {
    //     return $this->hasOne(Factura::class, 'id_notas_nas');
    // }

    // public function facturatiendita()
    // {
    //     return $this->hasOne(Factura::class, 'id_notas_nas_tiendita');
    // }

    public function factura(){
    return $this->hasOne(Factura::class, 'id_notas_nas', 'id')
                ->orWhere('facturas.id_notas_nas_tiendita', $this->id);
    }
}
