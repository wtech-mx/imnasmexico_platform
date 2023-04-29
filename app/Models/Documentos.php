<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    use HasFactory;

    protected $table = "documentos";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'ine',
        'curp',
        'foto_tam_titulo',
        'foto_tam_infantil',
        'firma',
        'carta_compromiso',
    ];

}
