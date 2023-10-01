<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamRenoEstandares extends Model
{
    use HasFactory;
    protected $table = 'cam_renovacion_estandares';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'id_renovacion',
        'id_estandar',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
}
