<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumenotsGenerador extends Model
{
    use HasFactory;
    protected $table = "documentos_generador";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_curso',
        'usuario_bitacora',
        'estado',
        'nota',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Cursos()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }
}