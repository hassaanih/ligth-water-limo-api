<?php

namespace App\Http\Controllers\Api\Web;

use App\Helpers\StripeHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Mail\ResetPasswordMail;
use App\Mail\RideCancellationMail;
use App\Mail\TestMail;
use App\Models\BookingDetails;
use App\Models\Bookings;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Mail\Mailer as MailMailer;
use Illuminate\Http\Response;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;


class TodoController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getList($responseCode)
    {
        Log::info('get list');
        $response = [];
        return response()->json($response, $responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postList(Request $request)
    {
        Log::info('post list');
        $response = [];

        $reqParams = array_filter($request->json()->all());

        $validationRules = ['code' => 'required'];
        $validationMessages = ['code.required' => 'code is required.'];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // return $reqParams['code'];
        return response()->json($response, $reqParams['code']);
    }

    public function testStripe(Request $request){
        try {
            // dd(StripeHelper::createCustomerCheckout(100, 'abc', 'def', 1));
            $cardDetails = [
                'card_number' => '4242424242424242',
                'expiry_month' => 12,
                'expiry_year' => 2023,
                'cvv' => '123',
            ];
            

              $charge = StripeHelper::chargePayment($cardDetails, 1000);

              $status = $charge;
              dd($status);
        
            // $charge = Charge::create([
            //     'customer' => $customer->id,
            //     'amount' => $request->input('amount'),
            //     'currency' => 'usd'
            // ]);
            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
        }
    }

    public function testEmail(Request $request, MailMailer $mail){
        try{
            $mail->to('hassaanih1997@gmail.com')->send(new TestMail(Bookings::find(2), BookingDetails::find(3), '321'));
        }catch(Throwable $e){
            Log::error($e->getMessage());
        }
    }
}
