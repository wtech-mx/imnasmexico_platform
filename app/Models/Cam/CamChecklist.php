<?php

namespace App\Models\Cam;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamChecklist extends Model
{
    use HasFactory;
    protected $table = 'cam_checklist';
    protected $primarykey = "id";

    protected $fillable = [
        'id_nota',
        '1',
        'id_usuario1',
        '2',
        'id_usuario2',
        '3',
        'id_usuario3',
        '4',
        'id_usuario4',
        '5',
        'id_usuario5',
        '6',
        'id_usuario6',
        '7',
        'id_usuario7',
        '8',
        'id_usuario8',
        '9',
        'id_usuario9',
        '10',
        'id_usuario10',
        '11',
        'id_usuario11',
        '12',
        'id_usuario12',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
    public function User1(){
        return $this->belongsTo(User::class, 'id_usuario1');
    }
    public function User2(){
        return $this->belongsTo(User::class, 'id_usuario2');
    }
    public function User3(){
        return $this->belongsTo(User::class, 'id_usuario3');
    }
    public function User4(){
        return $this->belongsTo(User::class, 'id_usuario4');
    }
    public function User5(){
        return $this->belongsTo(User::class, 'id_usuario5');
    }
    public function User6(){
        return $this->belongsTo(User::class, 'id_usuario6');
    }
    public function User7(){
        return $this->belongsTo(User::class, 'id_usuario7');
    }
    public function User8(){
        return $this->belongsTo(User::class, 'id_usuario8');
    }
    public function User9(){
        return $this->belongsTo(User::class, 'id_usuario9');
    }
    public function User10(){
        return $this->belongsTo(User::class, 'id_usuario10');
    }
    public function User11(){
        return $this->belongsTo(User::class, 'id_usuario11');
    }
    public function User12(){
        return $this->belongsTo(User::class, 'id_usuario12');
    }
}