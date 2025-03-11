<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'category_id',
        'unread_messages',
        'order',
        'color',
        'waba_phone_id',
        'waba_phone',
        'client_phone',
        'status',
        'expiration_timestamp',
        'origin',
        'bot',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function wabaPhone()
    {
        return $this->belongsTo(WabaPhone::class);
    }

    public function category()
    {
        return $this->belongsTo(ChatCategory::class);
    }
}
