<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'category',
        'language',
        'type',
        'template_id',
        'content',
        'waba_id',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
