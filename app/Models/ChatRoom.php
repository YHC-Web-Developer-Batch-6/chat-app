<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatRoom extends Model
{
    use HasFactory;

    protected $tables = 'chat_rooms';
    protected $guarded = [];

    function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
    function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
