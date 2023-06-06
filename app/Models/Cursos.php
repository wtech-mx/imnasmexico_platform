<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $table = "cursos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'carpeta',
        'fecha_inicial',
        'hora_inicial',
        'fecha_final',
        'hora_final',
        'categoria',
        'modalidad',
        'id_lugar',
        'objetivo',
        'temario',
        'sep',
        'unam',
        'stps',
        'redconocer',
        'imnas',
        'recurso',
        'informacion',
        'clase_grabada',
        'destacado',
        'slug',
        'precio',
        'materiales',
        'paquete',
        'video_cad',
        'seccion_unam',
        'texto_rvoe',
        'btn_cotizacion',
        'pdf',
        'sin_fin',
        'clase_grabada2',
        'clase_grabada3',
        'clase_grabada4',
        'clase_grabada5',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_profesor');
    }

    public function Carpeta()
    {
        return $this->belongsTo(Carpetas::class, 'carpeta');
    }

    public function RecordatoriosCursos()
    {
        return $this->hasMany(RecordatoriosCursos::class, 'id_curso');
    }

    public function CursosEstandares()
    {
        return $this->hasMany(CursosEstandares::class, 'id_carpeta');
    }

    public function CursosTickets()
    {
        return $this->hasMany(CursosTickets::class, 'id_curso');
    }

    public function OrdersTickets()
    {
        return $this->hasMany(OrdersTickets::class, 'id_curso');
    }
}
