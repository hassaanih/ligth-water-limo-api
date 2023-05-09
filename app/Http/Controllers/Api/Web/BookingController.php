<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\LocationTypes;
use App\Helpers\PriceCalculatorHelper;
use App\Http\Controllers\Api\BaseController;
use App\Models\BookingDetails;
use App\Models\BookingLocation;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        printf('hello');
        return $this->sendResponse('done', Response::HTTP_OK);
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBookingDetails(Request $request)
    {
        $reqParams = $request->all();

        $validator = Validator::make($reqParams, [
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'pickup_location' => 'required',
            'drop_location' => 'required',
            'travellers' => 'required',
            'kids' => 'required',
            'bags' => 'required',
            'total_km' => 'required'
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return $this->sendError($response, Response::HTTP_BAD_REQUEST);
        }
        try{

        }catch(Throwable $e){
            Log::error($e->getMessage());

        }
        $booking_details = new BookingDetails($reqParams);
        $booking_details->save();
        
        if(isset($reqParams['stops'])){
            foreach ($reqParams['stops'] as $stop) {
                $booking_location = new BookingLocation();
                $booking_location->location_type_id = LocationTypes::STOP;
                $booking_location->location = $stop['location'];
                $booking_location->booking_id = $booking_details->id;
                $booking_location->save();
            }
            $booking_details->total_stops = count($reqParams['stops']);
        }

        if(isset($reqParams['baby_chair'])){
            $booking_details->baby_chair = intval($reqParams['baby_chair']);
            $booking_details->total_charges += 30.00;
        }

        if(isset($reqParams['onsight_meetup'])){
            $booking_details->onsight_meetup = intval($reqParams['onsight_meetup']);
            $booking_details->flight_num = $reqParams['flight_num'];
            $booking_details->airline_name = $reqParams['airline_name'];
            $booking_details->arrival_time = $reqParams['arrival_time'];
            $booking_details->total_charges += 40.00;
        }
        $booking_details->update();
        $response['booking_details'] = $booking_details;
        return $this->sendResponse($response, Response::HTTP_OK);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBooking(Request $request)
    {
        $reqParams = $request->all();

        $validator = Validator::make($reqParams, [
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'booking_detail_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return $this->sendError($response, Response::HTTP_BAD_REQUEST);
        }

        $booking = new Bookings($reqParams);
        $booking->save();
        $response['booking'] = $booking;
        return $this->sendResponse($response, Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function selectVehicle(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validator = Validator::make($reqParams, [
            'id' => 'required',
            'vehicle_type_id' => 'required'
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return $this->sendError($response, Response::HTTP_BAD_REQUEST);
        }

        $booking_details = BookingDetails::where('id',$reqParams['id'])->with('vehicleType')->with('vehicle')->first();
        $booking_details->vehicle_id = isset($reqParams['vehicle_id']) ? $reqParams['vehicle_id'] : 0;
        $booking_details->vehicle_type_id = $reqParams['vehicle_type_id'];
        $booking_details->total_charges = PriceCalculatorHelper::getPrice($booking_details->distance, $booking_details->vehicle_type_id);
        $booking_details->update();
        $response['booking_details'] = $booking_details;
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
