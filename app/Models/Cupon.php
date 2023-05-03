<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "Cupon";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'tipo_de_descuento',
        'importe',
        'fecha_inicio',
        'fecha_fin',
        'gasto_min',
        'inc_cursos',
        'tipo_de_descuento',
        'estado',
        'limite_uso_por_cupon',
        'limite_uso_por_usuario',
        'id_usuario',
        'id_curso',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function Curso()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }


}
