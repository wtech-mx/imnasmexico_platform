<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamMiniExpDiplomas extends Model
{
    use HasFactory;
    protected $table = 'cam_mini_exp_diplomas';
    protected $primarykey = "id";

    protected $fillable = [
        'diplomas',
        'id_mini',
    ];

    public function MiniExp(){
        return $this->belongsTo(CamMiniExp::class, 'id_mini');
    }
}
