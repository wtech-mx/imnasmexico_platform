<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'num_order',
        'id_usuario',
        'pago',
        'forma_pago',
        'estatus',
        'fecha'
    ];
}