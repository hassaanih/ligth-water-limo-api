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
    public static function chargePayment($cardDetails, $amount){
        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $token = \Stripe\Token::create([
                'card' => [
                  'number' => $cardDetails['card_number'],
                  'exp_month' => $cardDetails['expiry_month'],
                  'exp_year' => $cardDetails['expiry_year'],
                  'cvc' => $cardDetails['cvv'],
                ],
              ]);

              $charge = \Stripe\Charge::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'description' => 'Charge for booking',
                'source' => $token->id,
              ]);

              $charge = Charge::retrieve($charge->id);

              $status = $charge->status;

              if($status === 'succeeded'){
                return true;
              }else{
                Log::error($charge);
                return false;
              }
        }catch(Throwable $e){
            Log::error('chargePayment'. $e->getMessage());
            return false;
        }
    }
}
