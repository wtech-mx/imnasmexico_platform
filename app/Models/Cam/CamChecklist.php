<?php

namespace App\Models\Cam;

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
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
    ];

    public function Nota(){
        return $this->belongsTo(CamNotas::class, 'id_nota');
    }
}
