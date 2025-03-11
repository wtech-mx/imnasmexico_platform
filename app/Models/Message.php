<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'timestamp',
        'sent_at',
        'delivered_at',
        'read_at',
        'message_id',
        'type',
        'direction',
        'sended_by',
        'body',
        'status',
        'response_to',
        'reaction',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
