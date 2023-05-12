<?php

namespace App\Http\Controllers\Api\Web;

use App\Helpers\StripeHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Response;
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
            dd(StripeHelper::createCustomerCheckout(100, 'abc', 'def', 1));
            // $customer = Customer::create([
            //     'email' => $request->input('email'),
            //     'source' => $request->input('stripeToken')
            // ]);
        
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
}
