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
        'paquete',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function NotasPagos()
    {
        return $this->hasOne('App\Models\NotasPagos', 'id_nota', 'id');
    }

    public function Order()
    {
        return $this->belongsTo(Orders::class, 'paquete');
    }
}
