<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportesCotizacionesMensajes extends Model
{
    use HasFactory;
    protected $table = "reportes_cotizaciones_mensajes";
    protected $primarykey = "id";

    protected $fillable = [
        'id_reporte',
        'foto',
    ];

    public function ReportesCotizaciones(){
        return $this->belongsTo(ReportesCotizaciones::class, 'id_reporte');
    }
}
