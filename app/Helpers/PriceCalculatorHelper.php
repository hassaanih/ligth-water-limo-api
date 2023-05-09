<?php 

namespace App\Helpers;

use Illuminate\Support\Str;

class PriceCalculatorHelper
{
	public static function getPrice($distance, $vehicle_type_id)
	{
		$default_price_for_sedan = 95;
		$default_price_for_suv = 115;
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
				return 0;
				break;
			default:
				return;
		}
	}

	
}
