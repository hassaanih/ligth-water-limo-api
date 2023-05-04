<?php

namespace App\Http\Controllers\Api\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Models\LookupVehicles;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class LookupVehiclesController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findAll(Request $request)
    {
        $response = [];
        $response['vehicles']=LookupVehicles::all();
        return $this->sendResponse($response, Response::HTTP_OK);
    }

    
}
