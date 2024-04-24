<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotasEstandaresEstatus extends Model
{
    use HasFactory;
    protected $table = '_notasestandares_estatus';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_estandar',
        'estatus',
        'evaluador',
        'id_usuario',
    ];

    public function NotasEstatus(){
        return $this->belongsTo(NotasEstatus::class, 'id_nota');
    }

    public function Estandar(){
        return $this->belongsTo(CamEstandares::class, 'id_estandar');
    }

    public function User(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
