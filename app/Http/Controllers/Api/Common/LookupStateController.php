<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\LookupState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class LookupStateController extends BaseController
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
            'name' => 'required',
            'abbreviation' => 'required',
            'country_id' => 'required'
        ];

        $validationMessages = [
            'name.required' => 'Name is required.',
            'abbreviation.required' => 'Abbreviation is required.',
            'country_id.required' => 'Country Id is required.'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // create record
        try {
            $model = new LookupState($reqParams);
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
            'name' => 'required',
            'abbreviation' => 'required',
            'country_id' => 'required'
        ];

        $validationMessages = [
            'name.required' => 'Name is required.',
            'abbreviation.required' => 'Abbreviation is required.',
            'country_id.required' => 'Country Id is required.'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);
        if ($validator->fails()) {
            $response['messages'] = $validator->errors();
            return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // update record 
        try {
            $model = LookupState::find($reqParams['id']);
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
        $lookupState = LookupState::find($id);
        if ($lookupState) {
            $lookupState->delete();
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
            'country_id' => 'required'
        ];

        $validationMessages = [
            'country_id.required' => 'Country Id is required.'
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
            'abbreviation',
            'country_id'
        ];
        $sort_order = 'asc';
        $filters = null;
        $response = array_filter($request->all());
        extract(array_filter($request->all()));

        // build query
        $query = LookupState::orderBy($sort_by, $sort_order)
            ->where('country_id', '=', $reqParams['country_id']);

        if ($page_size == -1) {
            $response['lookup_states'] = $query->select($select)->get();
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
        $lookupState = LookupState::find($id);

        if ($lookupState) {

            return $this->sendResponse(['lookup_state' => $lookupState], Response::HTTP_OK);
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
            $query = LookupState::with('country')->select('lookup_states.*');

            if ($request->get('search') && $request->get('search')['value']) {
                $query->whereRaw("lookup_states.name like ?", ["%{$request->get('search')['value']}%"]);
                $query->orWhereRaw("lookup_states.abbreviation like ?", ["%{$request->get('search')['value']}%"]);
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
        $lookupStates = LookupState::where('status', $status)->orderby('name', 'ASC')->get();
        return $this->sendResponse(['lookup_states' => $lookupStates], Response::HTTP_OK);
    }
}
