<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersCosmica extends Model
{
    use HasFactory;
    protected $table = "orders_cosmica";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'num_order',
        'id_usuario',
        'pago',
        'forma_pago',
        'estatus',
        'fecha',
        'code',
        'external_reference',
        'item_id_meli',
        'item_title_meli',
        'item_descripcion_meli',
        'item_descripcion_permalink',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function productos()
    {
        return $this->hasMany(ProductosNotasCosmica::class, 'id_notas_productos', 'id');
    }
}
