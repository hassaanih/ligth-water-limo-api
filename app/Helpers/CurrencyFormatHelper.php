<?php

namespace App\Helpers;

class CurrencyFormatHelper
{
	public static function money_format($value)
	{
		return number_format($value, 2, '.', ',');
	}
}
