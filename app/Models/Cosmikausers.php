<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cosmikausers extends Model
{
    use HasFactory;

    protected $table = "cosmikausers";

    protected $primarykey = "id";

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'membresia',
        'membresia_estatus',
        'puntos_acomulados',
        'membresia_inicio',
        'membresia_fin',
        'meses_acomulados',
        'consumido_totalmes',
        'direccion_local',
        'direccion_foto',
        'direccion_rs_face',
        'direccion_rs_insta',
        'direccion_rs_whats',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function getDiasRestantesAttribute()
    {
        $membresiaFin = Carbon::parse($this->membresia_fin);
        return Carbon::now()->diffInDays($membresiaFin, false);
    }

    // public function getPuntosFaltantesAttribute()
    // {
    //     $meta = $this->membresia === 'Cosmos' ? 1500 : ($this->membresia === 'Estelar' ? 2500 : 0);
    //     return max(0, $meta - $this->consumido_totalmes);
    // }

    public function getPuntosFaltantesAttribute()
{
    // Convertir consumido_totalmes a un número válido
    $consumido = (float) str_replace(',', '', $this->consumido_totalmes);

    // Establecer la meta según el tipo de membresía
    $meta = $this->membresia === 'Cosmos' ? 1500 : ($this->membresia === 'Estelar' ? 2500 : 0);

    // Calcular puntos faltantes
    return max(0, $meta - $consumido);
}


}
