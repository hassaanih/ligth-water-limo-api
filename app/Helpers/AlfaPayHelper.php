<?php

namespace App\Helpers;

use App\Models\CancellationPolicies;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class AlfaPayHelper
{
    public $handshakeRequstParam = null;
    public $transactionRequstParam = null;

    public static function initHandshakeRequestObject()
    {
        return [
            'HS_IsRedirectionRequest' => 0,
            'HS_RequestHash' => "",
            'HS_TransactionReferenceNumber' => '',
            'HS_ChannelId' => env('ALFA_CHANNEL_ID'),
            'HS_ReturnURL' => '',
            'HS_MerchantId' => env('ALFA_MERCHANT_ID'),
            'HS_StoreId' => env('ALFA_STOREID'),
            'HS_MerchantHash' => env('ALFA_MERCHANT_HASH'),
            'HS_MerchantUsername' => env('ALFA_MERCHANT_USERNAME'),
            'HS_MerchantPassword' => env('ALFA_MERCHANT_PASSWORD'),
        ];
    }

    public static function initTransactionRequestObject()
    {
        return [
            'AuthToken' => "",
            'RequestHash' => "",
            'Currency' => "PKR",
            'IsBIN' => 0,
            'ChannelId' => env('ALFA_CHANNEL_ID'),
            'ReturnURL' => '',
            'MerchantId' => env('ALFA_MERCHANT_ID'),
            'StoreId' => env('ALFA_STOREID'),
            'MerchantHash' => env('ALFA_MERCHANT_HASH'),
            'MerchantUsername' => env('ALFA_MERCHANT_USERNAME'),
            'MerchantPassword' => env('ALFA_MERCHANT_PASSWORD'),
            'TransactionTypeId' => 3,
            'TransactionReferenceNumber' => '',
            'TransactionAmount' => 0,
        ];
    }

    public static function generateRequestHash($requestParams, $extraHash)
    {
        $mapString = '';

        foreach ($requestParams as $key => $value) 
        {
            $mapString .= $key . "=" . $value . "&";
        }

        $mapString .= $extraHash;
        $method = 'aes-128-cbc';
        $key = utf8_encode(env('ALFA_KEY1'));
        $iv  = utf8_encode(env('ALFA_KEY2'));

        $mapString = utf8_encode($mapString.substr($mapString, 0, strlen($mapString) - 1));
        $ciphertext = base64_encode(openssl_encrypt($mapString, $method, $key, OPENSSL_RAW_DATA, $iv));
        return $ciphertext;
    }

    public function generateAuthToken()
    {
        // $this->handshakeRequstParam['HS_RequestHash'] = AlfaPayHelper::generateRequestHash($this->handshakeRequstParam, 'handshake=&');
        // return 'AUTH_TOKEN-123456789';

        $this->handshakeRequstParam['HS_RequestHash'] = AlfaPayHelper::generateRequestHash($this->handshakeRequstParam, 'handshake=&');

        $url = env('ALFA_HANDSHAKE_URL');
        $json = $this->handshakeRequstParam;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "ContentType: application/x-www-form-urlencoded",
        ));

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    public function assignValues($orderRefId, $grossPrice,$cartId)
    {
        $this->handshakeRequstParam = AlfaPayHelper::initHandshakeRequestObject();
        $this->transactionRequstParam = AlfaPayHelper::initTransactionRequestObject();
        $this->handshakeRequstParam['HS_TransactionReferenceNumber'] = $orderRefId;
        $this->transactionRequstParam['TransactionReferenceNumber'] = $orderRefId;
        $this->transactionRequstParam['TransactionAmount'] = $grossPrice;

        $this->handshakeRequstParam['HS_ReturnURL'] = env('ALFA_RETURN_URL').'/'.$cartId;
        $this->transactionRequstParam['ReturnURL'] = env('ALFA_RETURN_URL').'/'.$cartId;

        // $this->$handshakeRequstParam['HS_RequestHash'] = $this->generateRequestHash($this->handshakeRequstParam, 'handshake=&');
        $this->transactionData['AuthToken'] = $this->generateAuthToken();
        $this->transactionRequstParam['AuthToken'] = json_decode($this->transactionData['AuthToken'])->AuthToken;
        return $this->paymentPageRedirect();
    }

    public function paymentPageRedirect()
    {
        $this->transactionRequstParam['RequestHash'] = AlfaPayHelper::generateRequestHash($this->transactionRequstParam, 'run=&');

        $url = env('ALFA_PAGE_REDIRECT_URL');
        $json = $this->transactionRequstParam;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     "ContentType: application/x-www-form-urlencoded",
        // ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

        $data = curl_exec($curl);
        curl_close($curl);
        return $data;        
    }
}