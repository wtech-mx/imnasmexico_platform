<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialLabCosmica extends Model
{
    use HasFactory;
    protected $table = "historial_lab";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'id_envase',
        'user',
        'stock_viejo',
        'ocupado',
        'stock_nuevo',
        'fecha',
    ];

    public function Envases(){
        return $this->belongsTo(Envases::class, 'id_envase');
    }
}
