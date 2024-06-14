<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroImnas extends Model
{
    use HasFactory;
    protected $table = "registro_imnas_doc";
    protected $primarykey = "id";

    protected $fillable = [
        'id_usuario',
        'id_order',
        'num_guia',
        'fecha_compra',
        'fecha_realizados',
        'fecha_enviados',
        'nom_curso',
        'fecha_curso',
        'comentario_cliente',
        'folio',
        'estatus_cedula',
        'estatus_titulo',
        'estatus_diploma',
        'estatus_credencial',
        'estatus_tira',
        'nombre',
        'ine',
        'curp',
        'foto_cuadrada',
        'firma',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Orden()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }
}
