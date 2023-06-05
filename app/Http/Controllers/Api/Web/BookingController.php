<?php

namespace App\Http\Controllers\Api\Web;

use App\Enums\BookingStatus;
use App\Enums\LocationTypes;
use App\Helpers\PriceCalculatorHelper;
use App\Helpers\StripeHelper;
use App\Http\Controllers\Api\BaseController;
use App\Mail\TestMail;
use App\Models\BookingDetails;
use App\Models\BookingLocation;
use App\Models\Bookings;
use App\Models\LookupVehicles;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Mail\Mailer;
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
            Log::debug($response);
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        
        $booking_details = new BookingDetails($reqParams);
        $booking_details->save();

        if (isset($reqParams['stops'])) {
            foreach ($reqParams['stops'] as $stop) {
                $booking_location = new BookingLocation();
                $booking_location->location_type_id = LocationTypes::STOP;
                $booking_location->location = $stop['location'];
                $booking_location->booking_id = $booking_details->id;
                $booking_location->save();
            }
            $booking_details->total_stops = count($reqParams['stops']);
        }

        if ($reqParams['total_duration_hours'] != 0 && $reqParams['total_duration_minutes'] != 0) {
            $booking_details->total_duration_hours = $reqParams['total_duration_hours'];
            $booking_details->total_duration_minutes = $reqParams['total_duration_minutes'];
        }

        if ($reqParams['baby_chair'] != 0) {
            $booking_details->baby_chair = intval($reqParams['baby_chair']);
            $booking_details->total_charges += 30.00;
        }

        if (array_key_exists('onsight_meetup',$reqParams) && $reqParams['onsight_meetup'] != '') {
            $booking_details->onsight_meetup = $reqParams['onsight_meetup'];
            $booking_details->flight_num = $reqParams['flight_num'];
            $booking_details->airline_name = $reqParams['airline_name'];
            $booking_details->arrival_time = $reqParams['arrival_time'];
            $booking_details->total_charges += 40.00;
        }
        if(array_key_exists('flight_num', $reqParams) && $reqParams['flight_num'] != ''){
            $booking_details->total_charges += 5;
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
    public function createBooking(Request $request, Mailer $mail)
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
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $booking_details = BookingDetails::find($reqParams['booking_detail_id']);
        $reqParams['total_charges'] = $booking_details->total_charges + (array_key_exists('tip_for_driver', $reqParams) ? $reqParams['tip_for_driver'] : 0);

        if (!array_key_exists('card_details', $reqParams)) {
            $response['general'] = ['Please enter card details'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        Log::debug($reqParams['total_charges']);
        $paymentResponse = StripeHelper::chargePayment($reqParams['card_details'], intval($reqParams['total_charges']));
        if ($paymentResponse) {
            $booking = new Bookings($reqParams);
            $booking->save();
            $response['booking'] = $booking;
            $mail->to($reqParams['email'])->send(new TestMail($booking, $booking_details, substr($reqParams['card_details']['card_number'], -4)));
            return $this->sendResponse($response, Response::HTTP_OK);
        }

        $response['error']['general'] = ['Payment failed. Please try again'];
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
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $booking_details = BookingDetails::where('id', $reqParams['id'])->first();
        $booking_details->vehicle_id =  $reqParams['vehicle_id'];
        $booking_details->vehicle_type_id = $reqParams['vehicle_type_id'];
        Log::debug($reqParams['vehicle_id']);
        if (array_key_exists('vehicle_id', $reqParams) && $reqParams['vehicle_id'] != 0) {
            $vehicle = LookupVehicles::where('id', $reqParams['vehicle_id'])->first();
            if (!$vehicle) {
                $response['error']['general'] = ['Invalid Vehicle Id'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $booking_details->vehicle_type_id = $vehicle->vehicle_type_id;
            if (array_key_exists('total_duration_hours', $reqParams)) {
                $booking_details->total_charges += PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id, true, $booking_details->total_charges);
            } else {
                $booking_details->total_charges += PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id, false, $booking_details->total_charges);
            }
            $booking_details->total_charges += 20;
            $booking_details->update();
            $response['booking_details'] = BookingDetails::where('id', $reqParams['id'])->with('vehicleType')->with('vehicle')->first();
            return $this->sendResponse($response, Response::HTTP_OK);
        }
        if (array_key_exists('total_duration_hours', $reqParams)) {
            $booking_details->total_charges = PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id, true, $booking_details->total_charges);
        } else {
            $booking_details->total_charges = PriceCalculatorHelper::getPrice($booking_details->total_km, $booking_details->vehicle_type_id, false, $booking_details->total_charges);
        }

        $booking_details->update();
        $response['booking_details'] = BookingDetails::where('id', $reqParams['id'])->with('vehicleType')->with('vehicle')->first();
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
        $query = Bookings::with('details')->where('status', BookingStatus::ACTIVE)->orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, $page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignDriver(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validator = Validator::make($reqParams, [
            'id' => 'required',
            'driver_name' => 'required',
            'driver_payment' => 'required',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $bookings = Bookings::where('id', $reqParams['id'])->first();
        $bookings->diver_name =  $reqParams['driver_name'];
        $bookings->driver_payment = $reqParams['driver_payment'];
        $bookings->update();
        $response['bookings'] = Bookings::where('id', $reqParams['id'])->first();
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignSelf(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validator = Validator::make($reqParams, [
            'id' => 'required',
            'driver_name' => 'required',
            'driver_payment' => 'required',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $bookings = Bookings::where('id', $reqParams['id'])->first();
        $bookings->diver_name =  $reqParams['driver_name'];
        $bookings->driver_payment = $reqParams['driver_payment'];
        $bookings->update();
        $response['bookings'] = Bookings::where('id', $reqParams['id'])->first();
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validator = Validator::make($reqParams, [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return $this->sendResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $bookings = Bookings::where('id', $reqParams['id'])->first();
        $dateFromDb = Carbon::parse($bookings->details->pickup_date);
        Log::info($dateFromDb);
        $dateString = $dateFromDb->format('Y-m-d');
        Log::info($dateString);

        $carbonDateTime = Carbon::parse($dateString. ' ' . $bookings->details->pickup_time);
        Log::info($carbonDateTime);

        // Calculate the time difference between pickup time and current time
        $currentDateTime = Carbon::now();
        Log::info($currentDateTime);

        // Check if the time difference is less than or equal to 24 hours
        $hoursDifference = $carbonDateTime->diffInHours($currentDateTime);
        Log::info($hoursDifference);
        if ($hoursDifference <= 4) {
            $response['error']['general'] = ['Cannot cancel ride when 4 hours or less are left from pickup time'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        $bookings->status = BookingStatus::INACTIVE;
        $bookings->update();
        $response['bookings'] = Bookings::where('id', $reqParams['id'])->first();
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    public function find(Request $request, $email)
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
        $query = Bookings::with('details')->where('email', $email)->where('status', BookingStatus::ACTIVE)->orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, $page);
    }
}
