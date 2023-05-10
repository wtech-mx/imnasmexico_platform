<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaDia extends Model
{
    use HasFactory;
    protected $table = 'caja_dia';

    protected $fillable = [
        'fecha',
        'concepto',
        'egresos',
    ];
}
