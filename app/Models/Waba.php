<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waba extends Model
{
    use HasFactory;

    protected $table = 'wabas';

    protected $fillable = [
        'waba_id',
        'name',
        'timezone_id',
        'message_template_namespace',
        'currency',
        'status',
        'created_by',
        'updated_by',
    ];

    public function phones()
    {
        return $this->hasMany(WabaPhone::class);
    }
}
