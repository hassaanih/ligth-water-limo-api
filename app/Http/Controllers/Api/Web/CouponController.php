<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Api\BaseController;
use App\Models\BookingDetails;
use App\Models\Coupons;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CouponController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        $query = Coupons::orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:coupons',
            'total_discount' => 'required|numeric|min:0',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return $this->sendError(['error' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Create the coupon
        $coupon = Coupons::create([
            'code' => $request->input('code'),
            'total_discount' => $request->input('total_discount'),
            'usage_count' => $request->input('usage_count')
        ]);

        // Return success response with the created coupon
        return $this->sendResponse(['coupon' => $coupon], Response::HTTP_OK);
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
     * Apply coupon on booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applyToBooking(Request $request)
    {
        // Find the booking by ID
        $booking = BookingDetails::find($request->input('id'));

        // If the booking doesn't exist, return error response
        if (!$booking) {
            $response['error'] = ['No Bookings found'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:coupons,code',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        // Get the coupon based on the provided code
        $coupon = Coupons::where('code', $request->input('code'))->first();
        if($coupon->usage_count <= 0){
            $response['error']['general'] = ['Cannot use coupon'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        // Apply the coupon to the booking
        $booking->total_charges = $booking->total_charges - $coupon->total_discount;
        if ($booking->total_charges < 0) {
            $booking->total_charges = 0;
        }
        $coupon->usage_count++;
        $coupon->update();
        $booking->update();

        // Return success response
        $response['booking_details'] = $booking;
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the coupon by ID
        $coupon = Coupons::find($id);

        // If the coupon doesn't exist, return error response
        if (!$coupon) {
            $response['error'] = ['Cannot use coupon'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        // Delete the coupon
        $coupon->delete();

        // Return success response
        return $this->sendResponse(['message' => 'Coupon deleted successfully'], Response::HTTP_OK);
    }
}
