<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroImnasEspecialidad extends Model
{
    use HasFactory;
    protected $table = "registro_imnas_especialidad";
    protected $primarykey = "id";

    protected $fillable = [
        'id_cliente',
        'especialidad',
        'estatus',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_cliente');
    }

}
