<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Throwable;

class CurlHelper
{
	public static function exec($ch)
	{
		$response = [];
		try {
			$httpCode = 0;
			$content  = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$response['http_code'] = $httpCode;

			if ($httpCode != 200 && $httpCode != 201) {
				Log::debug('httpCode=' . $httpCode);
				Log::debug('content=' . $content);
				$response['error']['description'] = json_decode($content);
				return $response;
			}

			/*
			if ($content === FALSE) 
			{
				$response['error']['description'] = curl_error($ch);
				return json_decode(json_encode($response));
			}
			*/

			curl_close($ch);
			$response['response_body'] = json_decode($content, true);

			return $response;
		} catch (Throwable $e) {
			Log::error($e);
			$response['error']['description'] = $e->getMessage();
			return json_decode(json_encode($response));
		}
	}
}
