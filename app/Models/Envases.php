<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envases extends Model
{
    use HasFactory;
    protected $table = "envases";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'envase',
        'conteo',
        'cama',
        'imagen',
        'tipo',
    ];
}
