<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cosmikausers extends Model
{
    use HasFactory;

    protected $table = "cosmikausers";

    protected $primarykey = "id";

    public $timestamps = true;

    protected $fillable = [
        'id_cliente',
        'membresia',
        'membresia_estatus',
        'puntos_acomulados',
        'membresia_inicio',
        'membresia_fin',
        'meses_acomulados',
        'consumido_totalmes',
        'direccion_local',
        'direccion_foto',
        'direccion_rs_face',
        'direccion_rs_insta',
        'direccion_rs_whats',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

}
