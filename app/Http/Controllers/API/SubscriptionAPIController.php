<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Subscription::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|in:monthly,annual',
            'price' => 'required|numeric',
            'status' => 'required|in:active,cancelled',
        ]);

        $subscription = Subscription::create($request->all());

        return response()->json(['subscription' => $subscription], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subscription = Subscription::where('user_id', $id)->first();
        return response()->json($subscription, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Subscription cancelled'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $subscription = Subscription::create([
            'user_id' => $request->user_id,
            'plan_id' => $request->plan_id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addMonth(),
        ]);

        return response()->json(['subscription' => $subscription], 201);
    }
}
