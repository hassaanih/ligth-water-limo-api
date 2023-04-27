<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\BaseController;
use App\Models\BookingDetails;
use App\Models\Bookings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookingController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $booking_details = new BookingDetails($reqParams);
        $booking_details->save();
        $response['booking_details_id'] = $booking_details->id;
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
            'tip_for_driver' => 'required',
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
    public function store(Request $request)
    {
        //
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
