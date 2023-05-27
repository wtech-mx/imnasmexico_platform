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

    public function OrdersTickets()
    {
        return $this->hasOne('App\Models\OrdersTickets', 'id_order', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
