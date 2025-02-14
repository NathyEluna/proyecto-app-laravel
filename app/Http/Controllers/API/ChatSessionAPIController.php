<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatSessionAPIController extends Controller
{
    public function startChatSession(Request $request)
    {
        $request->validate([
            'game_session_id' => 'required|exists:game_sessions,id',
            'chatbot_id' => 'required|string',
        ]);

        $chatSession = ChatSession::create([
            'game_session_id' => $request->game_session_id,
            'chatbot_id' => $request->chatbot_id,
            'status' => 'active',
        ]);

        return response()->json(['chat_session' => $chatSession], 201);
    }

    public function endChatSession(Request $request, $id)
    {
        $chatSession = ChatSession::findOrFail($id);
        $chatSession->update([
            'status' => 'completed',
            'end_time' => now(),
        ]);

        return response()->json(['message' => 'Chat session ended successfully.']);
    }
}
