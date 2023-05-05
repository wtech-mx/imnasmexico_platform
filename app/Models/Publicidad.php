<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicidad extends Model
{
    use HasFactory;
    protected $table = "publicidad";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];
}
