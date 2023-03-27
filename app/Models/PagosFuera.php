<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosFuera extends Model
{
    use HasFactory;
    protected $table = "pagos_fuera";
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'curso',
        'modalidad',
        'inscripcion',
        'pendiente',
        'deudor',
        'abono',
        'foto',
    ];

    public function CursosTickets()
    {
       return $this->belongsTo(CursosTickets::class,'id_tickets');
    }
}
