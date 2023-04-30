<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosEstandares extends Model
{
    use HasFactory;
    protected $table = "documentos_estandares";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'ine',
        'id_usuario',
        'documento',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');

    }
}
