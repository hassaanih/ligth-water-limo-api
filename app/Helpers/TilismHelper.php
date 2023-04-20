<?php

namespace App\Helpers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class TilismHelper
{
	public static function sendSms($mobile_number, $message)
	{
		try {
			$response = [];

			$url = env('TILISM_URL');
			$username = env('TILISM_USERNAME');
			$password = env('TILISM_PASSWORD');
			$sender = env('TILISM_SENDER');

			$data = [
				"mobileno" => $mobile_number,
				"msgid" => "xxxxxxxx",
				"sender" => $sender,
				"message" => $message
			];
			Log::info($data);
			$encodedData = json_encode($data);

			$headers = [
				'Authorization:' . base64_encode($username . ':' . $password),
				'Content-Type: application/json',
			];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
			// Disabling SSL Certificate support temporarly
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
			// Execute curl
			$response = CurlHelper::exec($ch);
			if ($response['http_code'] != 200 && $response['http_code'] != 201) {
				return false;
				Log::debug($response);
			}

			return  $response['response_body'];
		} catch (Throwable $e) {
			Log::error($e);
			$response['messages']['errors'] = [$e->getMessage()];
			return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
