<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\LookupCountry;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class LookupCountryController extends BaseController
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
            'code_alpha2' => 'required',
            'name' => 'required',
            'code_num' => 'required'
        ];

        $validationMessages = [
            'code_alpha2.required' => 'Country code is required.',
            'name.required' => 'Name is required.',
            'code_num.required' => 'Dial code is required.'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }


        // create record
        try {
            $model = new LookupCountry($reqParams);
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
            'code_alpha2' => 'required',
            'name' => 'required',
            'code_num' => 'required'
        ];

        $validationMessages = [
            'code_alpha2.required' => 'Alphabetic code required',
            'name.required' => 'Name is required.',
            'code_num.required' => 'Dial code is required.'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // update record 
        try {
            $model = LookupCountry::find($reqParams['id']);
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
        $lookupCountry = LookupCountry::find($id);
        $response = [];
        if ($lookupCountry) {
            $lookupCountry->delete();
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
        $page = 1;
        $page_size = -1;
        $sort_by = 'id';
        $select = ['id', 'name', 'status'];
        $sort_order = 'asc';
        $filters = null;
        $response = array_filter($request->all());
        extract(array_filter($request->all()));

        // build query
        $query = LookupCountry::where('status', 'active')
            ->orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['lookup_countries'] = $query->select($select)->get();
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
        $lookupCountry = LookupCountry::find($id);

        if ($lookupCountry) {
            return $this->sendResponse(['lookup_country' => $lookupCountry], Response::HTTP_OK);
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
            $query = LookupCountry::select('lookup_countries.*');

            if ($request->get('search') && $request->get('search')['value']) {
                $query->whereRaw("lookup_countries.name like ?", ["%{$request->get('search')['value']}%"]);
                $query->orWhereRaw("lookup_countries.code_alpha2 like ?", ["%{$request->get('search')['value']}%"]);
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
        $lookupCountries = LookupCountry::where('status', $status)->orderby('name', 'ASC')->get();
        return $this->sendResponse(['lookup_countries' => $lookupCountries], Response::HTTP_OK);
    }
}
