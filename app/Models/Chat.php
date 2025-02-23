<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->with('fromUser')->orderBy('updated_at', 'desc');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_users');
    }

    //last message
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}
