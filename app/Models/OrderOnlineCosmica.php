<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOnlineCosmica extends Model
{
    use HasFactory;
    protected $table = "order_online_cosmica";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'nombre',
        'cantidad',
        'estatus',

    ];
    public function Orders()
    {
        return $this->belongsTo(OrdersCosmica::class, 'id_nota');
    }
}
