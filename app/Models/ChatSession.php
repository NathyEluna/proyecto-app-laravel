<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_session_id',
        'chatbot_id',
        'conversation_log',
        'start_time',
        'end_time',
        'status',
    ];

    public function gameSession()
    {
        return $this->belongsTo(GameSession::class);
    }
}
