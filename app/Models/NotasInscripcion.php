<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasInscripcion extends Model
{
    use HasFactory;
    protected $table = 'notas_inscripcion';

    protected $fillable = [
        'id_nota',
        'id_curso',
        'precio',
    ];

    public function Nota()
    {
        return $this->belongsTo(NotasCursos::class, 'id_nota');
    }

    public function CursosTickets()
    {
       return $this->belongsTo(CursosTickets::class,'id_curso');
    }
}
