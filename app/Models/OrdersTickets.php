<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersTickets extends Model
{
    use HasFactory;
    protected $table = "orders_tickets";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_tickets',
        'id_order',
        'cantidad',
    ];

    public function CursosTickets()
    {
       return $this->belongsTo(CursosTickets::class,'id_tickets');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Cursos()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }

    public function Orders()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }
}
