<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamVideosUser extends Model
{
    use HasFactory;
    protected $table = 'cam_videosuser';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        'tipo',
        'id_cliente',
        'check1',
        'check2',
        'check3',
        'check4',
        'check5',
        'check6',
        'check7',
        'check8',
        'check9',
        'check10',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }

    public function Cliente(){
        return $this->belongsTo(User::class, 'id_cliente');
    }
}
