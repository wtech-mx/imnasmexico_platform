<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroImnasEscuela extends Model
{
    use HasFactory;
    protected $table = "registro_imnas_escuela";
    protected $primarykey = "id";

    protected $fillable = [
        'id_user',
        'direccion_escuela',
        'firma',
        'otra_firma_director',
        'city_escuela',
        'state_escuela',
        'postcode_escuela',
        'country_escuela',
        'nombre_referencia',
        'direccion_referencia',
        'city_referencia',
        'state_referencia',
        'postcode_referencia',
        'country_referencia',
        'telefono_referencia',
        'email_referencia',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
