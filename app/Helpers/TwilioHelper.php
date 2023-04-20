<?php

namespace App\Helpers;

use Twilio;

class TwilioHelper
{
	public static function sendSms($mobile_number, $message)
	{
		Twilio::message($mobile_number, $message);
	}
}
