<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votos extends Model
{
    use HasFactory;
    protected $table = "votos";
    protected $primarykey = "id";
    public $timestamps = false;

    protected $fillable = [
        'concursante_id',
        'votos',
    ];

    public function User(){
        return $this->belongsTo(User::class, 'concursante_id');
    }
}
