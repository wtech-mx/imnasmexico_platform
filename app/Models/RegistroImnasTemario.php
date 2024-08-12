<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroImnasTemario extends Model
{
    use HasFactory;
    protected $table = "registro_imnas_temario";
    protected $primarykey = "id";

    protected $fillable = [
        'id_materia',
        'subtema',
    ];

    public function Especialidad(){
        return $this->belongsTo(RegistroImnasEspecialidad::class, 'id_materia');
    }
}
