<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revoes extends Model
{
    use HasFactory;
    protected $table = "revoes";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'name',
        'num_revoe',
        'image',
    ];
}
