<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOnlineNas extends Model
{
    use HasFactory;
    protected $table = "order_online_nas";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'nombre',
        'cantidad',
        'estatus',

    ];
}
