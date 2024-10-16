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
        'tam_letra_especialidad_th',
        'tam_letra_credencial_especialidad',
        'tam_letra_nombre_th',
        'tam_letra_folio_th',
        'tam_letra_especialidad_cedula',
        'tam_letra_folio_cedula',
        'tam_letra_folioTrasero_cedula',
        'tam_letra_lista_tira_materias',
        'capitalizar_nombre',
        'texto_director',
        'firma_director',
        'promedio',
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
