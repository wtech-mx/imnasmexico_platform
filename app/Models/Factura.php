<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = "facturas";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_orders',
        'factura',
    ];
}
