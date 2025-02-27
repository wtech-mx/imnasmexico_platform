<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportesCotizaciones extends Model
{
    use HasFactory;
    protected $table = "reportes_cotizaciones";
    protected $primarykey = "id";

    protected $fillable = [
        'id_cotizacion_cosmica',
        'id_cotizacion_nas',
        'fecha',
        'descripcion',
        'id_usuario',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function NotasProductosCosmica(){
        return $this->belongsTo(NotasProductosCosmica::class, 'id_cotizacion_cosmica');
    }
    public function NotasProductos(){
        return $this->belongsTo(NotasProductos::class, 'id_cotizacion_nas');
    }
}
