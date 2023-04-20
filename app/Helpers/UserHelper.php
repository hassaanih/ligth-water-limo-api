<?php 

namespace App\Helpers;

use Illuminate\Support\Str;

class UserHelper
{
	public static function generateAuthToken() : string 
	{
        return base64_encode(Str::random(40));
	}

	public static function generateOTPCode() : int 
	{
        return 123456;
        return rand (100000, 999999);
	}
}
