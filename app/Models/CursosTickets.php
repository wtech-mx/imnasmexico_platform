<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosTickets extends Model
{
    use HasFactory;
    protected $table = "cursos_tickets";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_curso',
        'nombre',
        'descripcion',
        'precio',
        'descuento',
        'fecha_inicial',
        'fecha_final',
        'costos_diferentes',
    ];

    // public function OrdersTickets()
    // {
    //     return $this->hasmany(OrdersTickets::class, 'id_tickets');
    // }

    public function Cursos()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }

}
