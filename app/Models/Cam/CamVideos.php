<?php

namespace App\Models\Cam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamVideos extends Model
{
    use HasFactory;

    protected $table = 'cam_videos';
    protected $primarykey = "id";

    protected $fillable = [
        'nombre',
        'video_url',
        'orden',
        'tipo',
    ];

}
