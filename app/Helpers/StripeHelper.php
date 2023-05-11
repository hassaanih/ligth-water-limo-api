<?php

namespace App\Helpers;

use App\Models\CancellationPolicies;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class StripeHelper
{
    public static function initPaymentIntent()
    {
        $amount = 1000; // amount in cents
        $currency = 'usd'; // currency code
        $description = 'Example Payment Intent'; // payment intent description
        $stripe_secret_key = env('STRIPE_SECRET'); // your Stripe secret key

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => 'https://api.stripe.com/v1/payment_intents',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query(array(
                'amount' => $amount,
                'currency' => $currency,
                'description' => $description,
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $stripe_secret_key,
            ),
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $payment_intent = json_decode($response);
        return $payment_intent;
    }
}
