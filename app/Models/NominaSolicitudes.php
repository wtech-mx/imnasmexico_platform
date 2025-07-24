<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NominaSolicitudes extends Model
{
    use HasFactory;
    protected $table = 'nomina_solicitudes';
    protected $fillable = [
        'id_users',
        'tipo_permiso',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'motivo',
        'estatus',
        'autorizado_por'
    ];
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];
    public function User(){
        return $this->belongsTo(User::class, 'id_users');
    }
}
