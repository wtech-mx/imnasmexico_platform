<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamEstandares extends Model
{
    use HasFactory;
    protected $table = 'cam_estandares';
    protected $primarykey = "id";

    protected $fillable = [
        'estandar',
        'id_usuario',
    ];
}
