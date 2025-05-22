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

    // Etiqueta de “documentación”
    public function getDocumentacionLabelAttribute()
    {
        if ($this->descripcion === 'Con opción a Documentos de certificadora IMNAS') {
            return 'IMNAS';
        }
        if ($this->descripcion === 'Opción a certificación a masaje holístico EC0900') {
            return 'Certificación a masaje holístico';
        }
        $labels = [];
        $curso = $this->Cursos;
        if ($curso->imnas)          $labels[] = 'IMNAS';
        if ($curso->titulo_hono)    $labels[] = 'Título honorífico';
        if ($curso->stps)           $labels[] = 'STPS';
        if ($curso->redconocer)     $labels[] = 'SepConocer';
        if ($curso->unam)           $labels[] = 'UNAM';
        return implode(' - ', $labels);
    }


}
