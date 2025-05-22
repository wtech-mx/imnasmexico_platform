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

    public function getStatusClassAttribute()
    {
        $campos = [
            $this->estatus_doc,
            $this->estatus_cedula,
            $this->estatus_titulo,
            $this->estatus_diploma,
            $this->estatus_credencial,
            $this->estatus_tira,
        ];
        return collect($campos)->every(fn($v) => $v === 1)
            ? 'estatus-doc-green'
            : 'estatus-doc-red';
    }

    // Facilita el contador de fila
    public function getRowNumberAttribute()
    {
        // blade usaría $loop->iteration en lugar de esto
        return $this->attributes['row_number'] ?? null;
    }

}
