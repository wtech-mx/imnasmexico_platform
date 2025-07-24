<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaTareas extends Model
{
    use HasFactory;
    protected $table = 'nomina_tareas';
    protected $fillable = [
        'id_users',
        'fecha',
        'titulo',
        'descripcion',
        'fecha_programada',
        'url',
        'documento1',
        'documento2',
        'tipo',
        'tipo_prioridad',
        'estatus'
    ];
    public function User()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,      // modelo relacionado
            'nomina_tareas_asignaciones',     // nombre exacto de la tabla pivote
            'id_tareas',       // FK en la pivote que apunta a este modelo (Aviso)
            'id_users'         // FK en la pivote que apunta a User
        )->withPivot('visto_en','clic_en')
        ->withTimestamps();
    }
}
