<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroImnasRelacionMat extends Model
{
    use HasFactory;
    protected $table = "registro_imnas_especialidad";
    protected $primarykey = "id";

    protected $fillable = [
        'id_materia',
        'id_user',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
