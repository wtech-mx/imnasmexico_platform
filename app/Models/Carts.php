<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_tickets',
        'id_user',
        'cantidad',
    ];
}
