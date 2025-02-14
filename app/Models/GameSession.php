<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'chatbot_id', 'start_time', 'end_time', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatbot()
    {
        return $this->belongsTo(Chatbot::class);
    }
}
