<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'reply_to_message_id',
        'from_user_id',
        'content',
        'created_at',
        'updated_at',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function replyToMessage()
    {
        return $this->belongsTo(Message::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class);
    }
}
