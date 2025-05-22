<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'num_order',
        'id_usuario',
        'id_admin',
        'pago',
        'forma_pago',
        'estatus',
        'fecha',
        'code',
        'external_reference',
        'clase_grabada_orden',
        'registro_imnas',
        'asistencia',
        'id_externo',
        'pago2',
        'forma_pago2',
        'foto',
        'foto2',
        'factura',
        'id_nota',

    ];

    public function OrdersTickets()
    {
        return $this->hasOne('App\Models\OrdersTickets', 'id_order', 'id');
    }

    public function FacturaOrders()
    {
        return $this->hasOne('App\Models\Factura', 'id_orders', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function Nota()
    {
        return $this->belongsTo(NotasCursos::class, 'id_nota');
    }

    public function PagosFuera()
    {
        return $this->belongsTo(PagosFuera::class, 'id_externo');
    }

    public function orderTickets()
    {
        return $this->hasMany('App\Models\OrdersTickets', 'id_order', 'id');
    }

    // ¿Quién subió?
    public function getUploaderNameAttribute()
    {
        if ($this->id_externo) {
            return $this->PagosFuera->usuario;
        }
        if ($this->id_admin) {
            return $this->Admin->name;
        }
        return 'Pago por página';
    }

    // ¿Es deudor?
    public function getIsDeudorAttribute()
    {
        // asumo que esa bandera viene de PagosFuera
        return optional($this->PagosFuera)->deudor == 1;
    }


}
