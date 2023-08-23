<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamCertificados extends Model
{
    use HasFactory;
    protected $table = 'cam_certificados';
    protected $primarykey = "id";

    protected $fillable = [
        'certificado',
        'id_cliente',
        'id_nota',
    ];
}
