<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaTareasAsignaciones extends Model
{
    use HasFactory;
    protected $table = 'nomina_tareas_asignaciones';
    protected $fillable = [
        'id_users',
        'id_tareas',
        'visto_en',
        'clic_en'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    public function Tarea()
    {
        return $this->belongsTo(NominaTareas::class, 'id_tareas');
    }
}
