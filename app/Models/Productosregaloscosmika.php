<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productosregaloscosmika extends Model
{
    use HasFactory;

    protected $table = "productosregaloscosmika";

    protected $primarykey = "id";

    public $timestamps = true;

    protected $fillable = [
        'id_cosmikausers',
        'tipo_amenidad',
        'cantidad',
        'productos',
        'estatus',
    ];
}
