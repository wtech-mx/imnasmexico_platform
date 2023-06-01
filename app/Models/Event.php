<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";
    protected $primarykey = "id";
    public $timestamps = true;


    protected $fillable = [
        'title',
         'start',
         'end',
         'id_profesor',
         'id_curso',
    ];
}
