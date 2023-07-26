<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;
    protected $table = "manual";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'modulo',
        'nombre',
        'descripcion',
        'imagen_portada',
        'nota',
        'step1_name',
        'step2_name',
        'step3_name',
        'step4_name',
        'step5_name',
        'step6_name',
        'step7_name',
        'step8_name',
        'step9_name',
        'step10_name',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',
        'foto6',
        'foto7',
        'foto8',
        'foto9',
        'foto10',
    ];

}
