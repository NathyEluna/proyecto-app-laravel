<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:paypal',
        ]);

        $payment = Payment::create([
            'user_id' => $request->user_id,
            'subscription_id' => $request->subscription_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'payment_date' => now(),
        ]);

        return response()->json(['payment' => $payment], 201);
    }
}
