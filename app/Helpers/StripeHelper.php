<?php

namespace App\Helpers;

use App\Models\CancellationPolicies;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Stripe;
use Throwable;

class StripeHelper
{
  public static function chargePayment($cardDetails, $amount)
  {
    Log::info("charge ");
    try {
      $token = StripeHelper::createToken($cardDetails);



      $charge = StripeHelper::createCharge($token, $amount, env('STRIPE_SECRET'));


      if(array_key_exists('error', $charge)){
        Log::info($charge['error']['code']);
        return ['status' => $charge['error']['code']];
      }else{
        $status = $charge['status'];
        if ($status === 'succeeded') {
          return $status;
        } else {
          Log::error($charge);
          return false;
        }
      }
    } catch (Throwable $e) {
      Log::error('chargePayment ' . $e->getMessage());
      return false;
    }
  }

  public static function createToken($cardDetails)
  {
    $apiKey = env('STRIPE_SECRET');

    $data = [
      'card' => [
        'number' => $cardDetails['card_number'],
        'exp_month' => $cardDetails['expiry_month'],
        'exp_year' => $cardDetails['expiry_year'],
        'cvc' => $cardDetails['cvv'],
      ],
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Authorization: Bearer ' . $apiKey,
    ]);

    $response = curl_exec($ch);

    if ($response === false) {
      // Handle cURL error
      $error = curl_error($ch);
      curl_close($ch);
      Log::error($error);
      return $error;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode !== 200) {
      // Handle API error
      return false;
    }

    curl_close($ch);

    $token = json_decode($response, true);
    $tokenId = $token['id'];

    // Use the token ID as needed
    Log::debug($tokenId);
    return $tokenId;
  }


  public static function createCharge($token, $amount, $apiKey)
  {
    $data = [
      'amount' => $amount * 100,
      'currency' => 'usd',
      'description' => 'Charge for booking',
      'source' => $token,
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/charges');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Authorization: Bearer ' . $apiKey,
    ]);

    $response = curl_exec($ch);
    Log::info($response);
    if ($response === false) {
      // Handle cURL error
      $error = curl_error($ch);
      curl_close($ch);
      echo 'cURL Error: ' . $error;
      return $error;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($httpCode !== 200) {
      // Handle API error
      curl_close($ch);
      return json_decode($response, true);
    }

    curl_close($ch);

    $charge = json_decode($response, true);
    Log::error($charge);
    // Access the charge details as needed
    return ['charge_id' => $charge['id'], 'status' => $charge['status']];
  }
}
