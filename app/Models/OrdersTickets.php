<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersTickets extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_tickets',
        'id_order',
        'cantidad',
    ];
}
