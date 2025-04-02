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
        'estatus_cotizacion',
        'estadociudad',
        'item_id_meli',
        'shippingId_meli',
        'item_title_meli',
        'item_descripcion_meli',
        'item_descripcion_permalink',
        'id_reposicion_nas',
        'id_reposicion_cosmica',
        'id_reposicion_user',
        'fecha_reposicion',
        'estatus_reposicion',
        'firma_reposicion',
        'nota_reposicion',

    ];
    public function NotasNAS()
    {
        return $this->belongsTo(NotasProductos::class, 'id_reposicion_nas');
    }
    public function NotasCosmica()
    {
        return $this->belongsTo(NotasProductosCosmica::class, 'id_reposicion_cosmica');
    }
    public function UserRepo()
    {
        return $this->belongsTo(User::class, 'id_reposicion_user');
    }
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
    public function productos()
    {
        return $this->belongsToMany(Products::class, 'productos_notas_cosmica', 'id_notas_productos', 'id_producto');
    }
}
