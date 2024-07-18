<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminos extends Model
{
    use HasFactory;
    protected $table = "terminos";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'nombre',
    ];
}
