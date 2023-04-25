<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebPage extends Model
{
    use HasFactory;
    protected $table = "web_page";
    protected $primarykey = "id";
    public $timestamps = true;

    protected $fillable = [
        'stone_home_bg',
        'stone_home_tittle',
        'stone_home_text',
        'parallax',
        'stfive_home_tittle',
        'stfive_home_text',
        'stseven_home_tittle',
        'stseven_home_text',
        'stpaquetesone_image',
        'stpaquetestwo_image',
        'stpaquetesthree_image',
        'stpaquetesfour_image',
        'stpaquetesfive_image',
        'stavalesunam_image',
        'stavalesconocer_image',
        'stavalesrevoe_image',
        'stavalesstps_image',
        'stavalesregistro_one_image',
        'stavalesregistro_two_image',
        'stavalesregistro_three_image',
        'stavalesregistro_four_image',
        'stavalesregistro_five_image',
        'stone_nosotros_bg',
        'stone_nosotros_tittle',
        'stone_nosotros_text',
        'stone_instalaciones_bg',
        'stone_instalaciones_tittle',
        'stone_instalaciones_text',
        'wb_all_pixel',
        'wb_all_analitics',
        'timestamps',
    ];
}
