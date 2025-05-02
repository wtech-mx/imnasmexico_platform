<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = "facturas";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_orders',
        'id_notas_cosmica',
        'id_notas_nas',
        'id_notas_nas_tiendita',
        'id_notas_cursos',
        'factura',
        'estado',
        'nota',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Orders()
    {
        return $this->belongsTo(Orders::class, 'id_orders');
    }

    public function NotasCosmica()
    {
        return $this->belongsTo(NotasProductosCosmica::class, 'id_notas_cosmica');
    }

    public function NotasNas()
    {
        return $this->belongsTo(NotasProductos::class, 'id_notas_nas');
    }

    public function NotasNasTiendita()
    {
        return $this->belongsTo(NotasProductos::class, 'id_notas_nas_tiendita');
    }

    public function NotasCursos()
    {
        return $this->belongsTo(NotasCursos::class, 'id_notas_cursos');
    }

}
