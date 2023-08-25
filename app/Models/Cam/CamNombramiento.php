<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamNombramiento extends Model
{
    use HasFactory;
    protected $table = 'cam_nombramientos';
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'id_cliente',
        'id_nota',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }

    public function Cliente(){
        return $this->belongsTo(User::class, 'id_cliente');
    }
}
