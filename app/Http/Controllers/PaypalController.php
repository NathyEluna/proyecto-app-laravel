<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaypalController extends Controller
{
    public function createPayment(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $request->amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id'])) {
            return response()->json($response);
        } else {
            return response()->json(["error" => "Payment creation failed"], 400);
        }
    }

    public function capturePayment(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->order_id);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            Payment::create([
                'user_id' => auth()->id(),
                'plan_id' => $request->plan_id,
                'amount' => $request->amount,
                'payment_status' => 'success',
                'payment_date' => now(),
                'payment_method' => 'paypal'
            ]);
            return response()->json(["success" => "Payment successful"]);
        } else {
            return response()->json(["error" => "Payment failed"], 400);
        }
    }
}
