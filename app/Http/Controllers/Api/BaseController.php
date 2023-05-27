<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($responseData, $code = Response::HTTP_OK)
    {
        return response()->json($responseData, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($responseData, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json($responseData, $code);
    }
}
