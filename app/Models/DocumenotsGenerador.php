<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumenotsGenerador extends Model
{
    use HasFactory;
    protected $table = "documentos_generador";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_curso',
        'id_usuario_bitacora',
        'estado',
        'fotografia',
        'folio',

        'folio',
        'tipo_documento',
        'cliente',
        'curso',
        'fecha_inicial',
        'fecha_final',
        'duracion_hrs',
        'fotografia',
        'foto',
        'curp',
        'firma',
        'promedio',
    ];

    public function Alumno()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario_bitacora');
    }

    public function Cursos()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }
}
