<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosEstandares extends Model
{
    use HasFactory;
    protected $table = "cursos_estandares";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'id_carpeta',
    ];

    public function Curso()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }
    public function CarpetasEstandares()
    {
        return $this->belongsTo(CarpetasEstandares::class, 'id_carpeta');
    }
    
    public function CarpetaEstandar()
    {
        return $this->belongsTo(CarpetaEstandar::class, 'id_carpeta');
    }
}
