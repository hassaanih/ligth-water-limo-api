<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PgSql\Lob;

class PriceCalculatorHelper
{
	public static function getPrice($distance, $vehicle_type_id)
	{
		Log::info('distance '. $distance);
		$default_price_for_sedan = 95;
		$default_price_for_suv = 115;
		$default_price_for_own_vehicle = 20;
		switch($vehicle_type_id){
			case 1:
				//sedan
				if($distance > 20){
					$remaining_distance = $distance - 20;
					return $remaining_distance * 4;
				}
				return $default_price_for_sedan;
				break;
			case 2:
				//suv
				if($distance > 20){
					$remaining_distance = $distance - 20;
					return $remaining_distance * 5;
				}
				return $default_price_for_suv;
				break;
			case 3:
				if($distance > 20){
					$remaining_distance = $distance - 20;
					return $remaining_distance * 5;
				}
				return $default_price_for_own_vehicle;
				break;
			default:
				return;
		}
	}

	
}
