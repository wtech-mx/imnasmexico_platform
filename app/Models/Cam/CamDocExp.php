<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamDocExp extends Model
{
    use HasFactory;
    protected $table = 'cam_docexp';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'nombre',
        'tipo',
        'id_cliente',
        'id_usuario',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
}
