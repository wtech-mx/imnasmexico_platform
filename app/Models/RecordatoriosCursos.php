<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordatoriosCursos extends Model
{
    use HasFactory;
    protected $table = 'recordatorios_cursos';

    protected $fillable = [
        'User',
        'nombre',
        'email',
        'telefono',
        'estatus',
        'nota',
    ];
}
