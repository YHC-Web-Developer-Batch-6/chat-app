<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';
    protected $guarded = [];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function chatMessages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
