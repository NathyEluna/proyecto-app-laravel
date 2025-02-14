<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GameSession;;
use Illuminate\Http\Request;

class GameSessionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(GameSession::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chatbot_id' => 'required|string',
            'status' => 'required|in:active,completed',
        ]);

        $gameSession = GameSession::create($request->all());

        return response()->json(['game_session' => $gameSession], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(GameSession::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gameSession = GameSession::findOrFail($id);
        $gameSession->update(['status' => 'completed']);

        return response()->json(['message' => 'Game session completed'], 200);
    }

    public function startSession(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chatbot_id' => 'required|exists:chatbots,id',
        ]);

        $session = GameSession::create([
            'user_id' => $request->user_id,
            'chatbot_id' => $request->chatbot_id,
            'start_time' => now(),
            'status' => 'active',
        ]);

        return response()->json(['game_session' => $session], 201);
    }
}
