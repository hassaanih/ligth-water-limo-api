<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\LookupCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class LookupCityController extends BaseController
{
    /**
     * create object.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = [];
        $reqParams = $request->json()->all();

        // validate request
        $validationRules = [
            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
        ];

        $validationMessages = [
            'country_id.required' => 'Country Id is required.',
            'state_id.required' => 'State Id is required.',
            'name.required' => 'Name is required.',
        ];

        $validator = Validator::make(
            $reqParams,
            $validationRules,
            $validationMessages
        );
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // create record
        try {
            $model = new LookupCity($reqParams);
            $model->save();
            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            $response['messages']['errors'] = [$e->getMessage()];
            return $this->sendError(['general' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * update object.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = [];
        $reqParams = $request->json()->all();

        $validationRules = [
            'country_id' => 'required',
            'state_id' => 'required',
            'name' => 'required',
        ];

        $validationMessages = [
            'country_id.required' => 'Country Id is required.',
            'state_id.required' => 'State Id is required.',
            'name.required' => 'Name is required.',
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // update record 
        try {
            $model = LookupCity::find($reqParams['id']);
            if (!$model) {
                $response['messages']['errors'][] = 'Object not found.';
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $model->update($reqParams);
            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            $response['messages']['errors'] = [$e->getMessage()];
            return $this->sendError(['general' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * delete object.
     *
     * @param  App\Models\Page $page
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $response = [];
        $lookupCity = LookupCity::find($id);

        if ($lookupCity) {
            $lookupCity->delete();
            return $this->sendResponse($response, Response::HTTP_OK);
        } else {
            return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
        }
    }

    /**
     * return paginated list.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $reqParams = $request->json()->all();
        $validationRules = [
            'state_id' => 'required'
        ];

        $validationMessages = [
            'state_id.required' => 'State Id is required.'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $page = 1;
        $page_size = -1;
        $sort_by = 'id';
        $select = [
            'id',
            'name',
            'country_id',
            'state_id',
            'status',
            'blueex_code'
        ];
        $sort_order = 'asc';
        $filters = null;
        $response = array_filter($request->all());
        extract(array_filter($request->all()));

        // build query
        $query = LookupCity::orderBy($sort_by, $sort_order)
            ->where('state_id', '=', $reqParams['state_id'])
            ->where('status', 'active');

        if ($page_size == -1) {
            $response['lookup_cities'] = $query->select($select)->get();
            return $this->sendResponse($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, 'page', $page);
    }

    /**
     * return object.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function find($id)
    {
        $lookupCity = LookupCity::find($id);
        if ($lookupCity) {
            return $this->sendResponse(['lookup_city' => $lookupCity], Response::HTTP_OK);
        }
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * find all data table object.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */

    public function listDatatable(Request $request)
    {
        if (true || $request->ajax()) {
            $query = LookupCity::with('country')->select('lookup_cities.*');

            if ($request->get('search') && $request->get('search')['value']) {
                $query->whereRaw("lookup_cities.name like ?", ["%{$request->get('search')['value']}%"]);
            }

            return DataTables::of($query)
                ->filter(function ($query) use ($request) {
                })
                ->setRowAttr([
                    'canUpdate' => function ($row) {
                        return true;
                    },
                ])
                ->make(true);
        }
        abort(404);
    }

    /**
     * return object.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function findByStatus($status)
    {
        $lookupCities = LookupCity::where('status', $status)->orderby('name', 'ASC')->get();
        return $this->sendResponse(['lookup_cities' => $lookupCities], Response::HTTP_OK);
    }
}
