<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estandar extends Model
{
    use HasFactory;
    protected $table = "estandares";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'name',
        'num_estandar',
        'image',
    ];
}
