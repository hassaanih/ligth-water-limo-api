<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class FcmHelper
{
	public static function sendNotification($type, $receiver_user_ids, $message, $data)
	{
		try {
			$response = [];
			$url = env('FCM_URL');
			$fcmToken = User::whereIn('id', $receiver_user_ids)->pluck('fcm_token');
			if (count($fcmToken) > 0) {
				$serverKey = env('FCM_KEY');
				$fcmData = [
					"registration_ids" => $fcmToken,
					"notification" => [
						"title" => $message,
						// "body" => " Likes Your Post",
					],
					"data" => $data,

				];
				// return json_encode($data);
				$encodedData = json_encode($fcmData);

				$headers = [
					'Authorization:key=' . $serverKey,
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
				// Execute post
				$result = curl_exec($ch);
				if ($result === FALSE) {
					die('Curl failed: ' . curl_error($ch));
				}
				// Close connection
				curl_close($ch);
				// FCM response
				return $result;
			}
		} catch (Throwable $e) {
			Log::error($e);
			$response['messages']['errors'] = [$e->getMessage()];
			return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
}
