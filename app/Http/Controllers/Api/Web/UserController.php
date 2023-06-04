<?php

namespace App\Http\Controllers\Api\Web;

use App\Components\Sms\Contracts\SMS;
use App\Components\Sms\Drivers\Driver;
use App\Enums\UserStatus;
use App\Facades\SMSGateway;
use App\Helpers\CommonHelper;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Jobs\sendEmailOtpJob;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Models\Users;
use App\Models\UserSignup;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends BaseController
{
    /**
     * Create user API
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $reqParams = array_filter($request->all());

            $validationMessages = [
                'email.required' => 'Email is required.',
                'email.unique' => 'Email is already taken.',
                'email.regex' => 'Email format is invalid.',
            ];

            $validationRules = [
                'full_name' => 'required',
                'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // create model
            $reqParams['password'] = Hash::make($reqParams['password']);
            $user = Users::create($reqParams);

            // store profile_photo if exist

            $user->save();
            // send response
            $response = [];
            $response['user'] = $user;

            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Sign in API
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        try {
            // TODO :: array_filter replace with our custom array filter created recently in some project
            $reqParams = array_filter($request->all());

            $validationMessages = [
                'email.required' => 'Email is required.',
                'password.required' => 'Password is required.',
            ];

            $validationRules = [
                'email' => 'required',
                'password' => 'required',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // validate credentials
            $user = Users::where('email', $reqParams['email'])->first();
            if (!$user) {
                $response['error'] = ['No user exist with this email'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            if (($reqParams['email'] == $user->email) && (Hash::check($reqParams['password'], $user->password))){
                $response['user'] = $user;
                return $this->sendResponse($response);
            }else{
                $response['error']['general'] = ['Invalid email or password'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['general' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Sign out API
     *
     * @return \Illuminate\Http\Response
     */
    public function signout(Request $request)
    {
        try {
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
            }
            return $this->sendResponse(null, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
     * Reset passowrd using current password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $response = [];
        $reqParams = $request->all();
        try {
            // validate request
            $validationRules = [
                'code' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ];

            $validationMessages = [
                'code' => 'user not found',
                'password.required' => 'New Password is required.',
                'confirm_password.required' => 'Confirm Password is required.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $user = Users::where('code', $reqParams['code'])->first();
            if(!$user){
                $response['error'] = ['User not found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $user->password = Hash::make($reqParams['password']);
            $user->code = md5(time());
            $user->update();

            return $this->sendResponse([], Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sendEmailForResetPassword(Request $request){
        $response = [];
        $reqParams = $request->all();
        try {
            // validate request
            $validationRules = [
                'email' => 'required',
            ];

            $validationMessages = [
                'email' => 'user not found',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $user = Users::where('email', $reqParams['email'])->first();
            if(!$user){
                $response['error'] = ['User not found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $code = md5(time());
            Mail::to($user->email)->send(new ResetPasswordMail($code)); 
            return $this->sendResponse([], Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show all user list
     *
     * @return \Illuminate\Http\Response
     */
    public function findAll(Request $request)
    {
        try {

            $reqParams = $request->json()->all();

            $select = [
                'id',
                'full_name'
            ];

            $page = 1;
            $page_size = 10;
            $sort_by = 'full_name';
            $sort_order = 'ASC';


            $response = CommonHelper::filterEmptyValues($request->all());
            extract($response);

            //build query
            $query = Users::orderBy($sort_by, $sort_order);

            //Search query by name 
            if (array_key_exists('full_name', $reqParams['filter']))
                $query->where('full_name', 'LIKE', '%' . $reqParams['filter']['full_name'] . '%');

            if ($page_size == -1) {
                $response['data'] = $query->select($select)->get();
                return $this->sendResponse($response, Response::HTTP_OK);
            }

            $response = array_merge($response, $query->paginate($page_size, $select, 'page', $page)->toArray());

            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['general' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
