<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\LocationTypes;
use App\Helpers\PriceCalculatorHelper;
use App\Helpers\StripeHelper;
use App\Http\Controllers\Api\BaseController;
use App\Models\BookingDetails;
use App\Models\BookingLocation;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

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
            $booking_details->onsight_meetup = $reqParams['onsight_meetup'];
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
        // dd($reqParams);
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

        $booking_details = BookingDetails::find($reqParams['booking_detail_id']);
        $reqParams['total_charges'] = $booking_details->total_charges + (array_key_exists('tip_for_driver',$reqParams) ? $reqParams['tip_for_driver'] : 0);

        if(!array_key_exists('card_details', $reqParams)){
            $response['general'] = ['Please enter card details'];
            return $this->sendError($response, Response::HTTP_BAD_REQUEST);
        }

        $paymentResponse = StripeHelper::chargePayment($reqParams['card_details'], $reqParams['total_charges']);
        if($paymentResponse){
            $booking = new Bookings($reqParams);
            $booking->save();
            $response['booking'] = $booking;
            return $this->sendResponse($response, Response::HTTP_OK);
        }

        $response['general'] = ['payment failed'];
        return $this->sendError($response, Response::HTTP_BAD_GATEWAY);

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
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return $this->sendError($response, Response::HTTP_BAD_REQUEST);
        }

        $booking_details = BookingDetails::where('id',$reqParams['id'])->first();
        $booking_details->vehicle_id =  $reqParams['vehicle_id'];
        $booking_details->vehicle_type_id = $reqParams['vehicle_type_id'];
        if(array_key_exists('total_duration_hours', $reqParams)){
            $booking_details->total_charges = PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id, true);
        }else{
            $booking_details->total_charges = PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id);
        }
        $booking_details->update();
        $response['booking_details'] = BookingDetails::where('id',$reqParams['id'])->with('vehicleType')->with('vehicle')->first();
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * list Banquet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findAll(Request $request)
    {
        $page = 1;
        $page_size = 10;

        $sort_by = 'created_at';
        $select = '*';

        $sort_order = 'desc';
        $filters = null;
        $response = array_filter($request->all());
        extract(array_filter($request->all()));

        // build query
        $query = Bookings::with('details')->orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select,$page);

    }
}
