<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialClase extends Model
{
    use HasFactory;
    protected $table = 'materialclase';

    protected $fillable = [
        'id_curso',
        'nombre',
        'file',
    ];
}
