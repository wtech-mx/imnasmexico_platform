<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamCedulas extends Model
{
    use HasFactory;
    protected $table = 'cam_cedulas';
    protected $primarykey = "id";

    protected $fillable = [
        'cedula',
        'id_cliente',
        'id_nota',
    ];
}
