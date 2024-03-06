<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;
    protected $table = 'chat_messages';
    protected $guarded = [];

    function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    function chatRoom(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class);
    }
}
