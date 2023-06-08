<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PgSql\Lob;

class PriceCalculatorHelper
{
	public static function getPrice($distance, $vehicle_type_id, $isHourly=false, $total_minutes)
	{
		Log::info('distance '. $distance);
		$default_price_for_sedan = 95;
		$default_price_for_suv = 115;
		$default_price_for_sedan_hourly = 1.41;
		$default_price_for_suv_hourly = 1.41;
		switch($vehicle_type_id){
			case 1:
				//sedan
				if($isHourly){
					if($distance > 20){
						$remaining_distance = $distance - 20;
						Log::debug('remaining distance '. $remaining_distance);
						return (($remaining_distance * 2) + ($default_price_for_sedan_hourly * $total_minutes));
					}
					return $default_price_for_sedan;

				}
				if($distance > 20){
					$remaining_distance = $distance - 20;
					return (($remaining_distance * 2) + $default_price_for_sedan);
				}
				return $default_price_for_sedan;
				break;
			case 2:
				//suv
				if($isHourly){
					if($distance > 20){
						$remaining_distance = $distance - 20;
						return (($remaining_distance * 2.5) + ($default_price_for_suv_hourly * $total_minutes));
					}
					return $default_price_for_suv;

				}
				if($distance > 20){
					$remaining_distance = $distance - 20 ;
					return (($remaining_distance * 4) + $default_price_for_suv);
				}
				return $default_price_for_suv;
				break;
			default:
				return;
		}
	}

	
}
