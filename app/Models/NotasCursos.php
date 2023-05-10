<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasCursos extends Model
{
    use HasFactory;
    protected $table = 'notas_curso';

    protected $fillable = [
        'id_usuario',
        'fecha',
        'total',
        'restante',
        'nota',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
