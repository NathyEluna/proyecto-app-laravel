<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Plan::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:plans,name|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $plan = Plan::create($request->all());

        return response()->json(['plan' => $plan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);
        return response()->json($plan, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|unique:plans,name|max:255',
            'price' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|string',
        ]);

        $plan->update($request->all());

        return response()->json(['message' => 'Plan updated successfully', 'plan' => $plan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return response()->json(['message' => 'Plan deleted successfully'], 200);
    }
}
