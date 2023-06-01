<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarpetasEstandares extends Model
{
    use HasFactory;
    protected $table = "carpetas_estandares";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function CarpetaDocumentosEstandares()
    {
        return $this->hasMany(CarpetaDocumentosEstandares::class, 'id_carpeta');
    }
}
