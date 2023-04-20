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
use App\Models\User;
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
                'profile_photo' => ['mimes:png,jpg,jpeg,webp'],

            ];

            $validationRules = [
                'full_name' => 'required',
                'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'profile_photo.mimes' => 'Uploaded file is not an image. Please upload an image.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // create model
            $reqParams['password'] = bcrypt($reqParams['password']);
            $user = UserSignup::create($reqParams);

            // store profile_photo if exist
            if ($request->hasFile('profile_photo')) {
                $storageFolder = "users/{$user->id}";
                Storage::makeDirectory($storageFolder);
                $user->profile_photo_path = $request->file('profile_photo')->store($storageFolder);
            }
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
            if (!Auth::attempt(['email' => $reqParams['email'], 'password' => $reqParams['password'],])) {
                return $this->sendError(
                    ['general' => ['The combination of user ID and password entered is invalid.']],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $user = Auth::user();
            if ($user->status == UserStatus::INACTIVE) {
                return $this->sendError(
                    ['general' => ['Account is inactive. Please contact support.']],
                    Response::HTTP_BAD_REQUEST
                );
            }

            if (!empty($reqParams['fcm_token'])) {
                $user->fcm_token = $reqParams['fcm_token'];
            }

            $user->save();

            // send response
            $response = [];
            $response['user'] = $user;
            $response['user']['token'] = $user->createToken('MyApp')->plainTextToken;
            return $this->sendResponse($response);
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
     * Send OTP Code to login user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendEmailOtp($id)
    {
        $response = [];

        try {
            // find user and send OTP
            $userSignup = UserSignup::find($id);
            $userSignup->email_otp_code = UserHelper::generateOTPCode();
            $userSignup->save();

            try {
                dispatch(new SendEmailOtpJob($userSignup));
            } catch (Throwable $em) {
                Log::error($em);
            }
            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Verify email OTP Code and update user email OTP status
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyEmailOtp(Request $request)
    {
        $response = [];
        $reqParams = array_filter($request->json()->all());
        try {
            // validate request
            $validationRules = [
                'id' => 'required',
                'otp_code' => 'required',
            ];

            $validationMessages = [
                'id.required' => 'Id is required.',
                'otp_code.required' => 'Email OTP code is required.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);
            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            // verify and update otp status of user
            $userSignup = UserSignup::find($reqParams['id']);
            if ($userSignup->email_otp_code != $reqParams['otp_code']) {

                $response['messages']['otp_code'] = ['Invalid OTP Code'];
                return $this->sendError($response, Response::HTTP_BAD_REQUEST);
            }

            // check whether full_name/email and mobile_number already exists in user table
            $user = User::where('full_name', $userSignup->full_name)->first();

            if ($user) {
                $response['messages']['full_name'] = ['full_name already exists.'];
                return $this->sendError($response, Response::HTTP_BAD_REQUEST);
            }

            $user = User::where('email', $userSignup->email)->first();

            if ($user) {
                $response['messages']['email'] = ['Email already exists.'];
                return $this->sendError($response, Response::HTTP_BAD_REQUEST);
            }

            $userSignup->email_otp_verified = true;
            $userSignup->save();

            // insert data from user_signup to user table and than delete data from 
            $newUser = new User();
            $newUser->id = $userSignup->id;
            $newUser->user_type_id = $userSignup->user_type_id;
            $newUser->password = $userSignup->password;
            $newUser->full_name = $userSignup->full_name;
            $newUser->email = $userSignup->email;
            $newUser->dial_code = $userSignup->dial_code;
            $newUser->mobile_number = $userSignup->mobile_number;
            $newUser->profile_photo_path = $userSignup->profile_photo_path;
            $newUser->mobile_otp_verified = $userSignup->mobile_otp_verified;
            $newUser->email_otp_verified = $userSignup->email_otp_verified;
            $newUser->email_otp_code = $userSignup->email_otp_code;
            $newUser->mobile_otp_code = $userSignup->mobile_otp_code;
            $newUser->address = $userSignup->address;
            $newUser->save();

            $userSignup->delete();
            $response['user'] = User::find($reqParams['id']);
            $response['user']['token'] = $newUser->createToken('MyApp')->plainTextToken;

            return $this->sendResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Send OTP Code to login user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMobileOtp($id)
    {
        $response = [];

        try {
            // find user and send OTP
            $user = User::find($id);
            $user->mobile_otp_code = UserHelper::generateOTPCode();
            $user->save();

            // send OTP
            $message = "Your Vaqra.app verfication code is {$user->mobile_otp_code}";
            // SmsHelper::sendSMS($user->full_mobile_number, $message);
            Log::info($user);

            $sms = SMSGateway::send($user->full_mobile_number, $message);
            Log::info('After Sms');
            $response['mobile_otp_code'] = $user->mobile_otp_code;
            return $this->sendResponse($sms, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return $this->sendError(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * update Photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function uploadOrRmovePhotoOfField($field_key, Request $request)
    {
        $reqParams = $request->all();
        $field_path = $field_key . '_path';
        $field_url = $field_key . '_url';
        $user = Auth::user();
        // remove if url deleted
        try {
            if (!empty($user->$field_path) && empty($reqParams[$field_url])) {
                Storage::delete($user->$field_path);
                $user->$field_path = NULL;
            }
        } catch (Throwable $e) {
            Log::error($e);
        }

        // store profile_photo if exist
        if ($request->hasFile($field_key)) {
            // delete if old profile photo exist
            try {
                if (!empty($user->$field_path)) {
                    // delete from storage
                    Storage::delete($user->$field_path);
                }
            } catch (Throwable $e) {
                Log::error($e);
            }

            // save uploaded photo
            try {
                $storageFolder = "users/{$user->id}";
                Storage::makeDirectory($storageFolder);
                $user->$field_path = $request->file($field_key)->store($storageFolder);
            } catch (Throwable $e) {
                Log::error($e);
            }
        }
        return  $user->$field_path;
    }

    /**
     * As a Login User, update my Profile
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            // return $request;

            $response = [];
            $reqParams = array_filter($request->all());
            // validate request
            $validationRules = [
                'profile_photo' => ['mimes:png,jpg,jpeg,webp'],
            ];

            $validationMessages = [
                'profile_photo.mimes' => 'Uploaded file is not an image. Please upload an image.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }
            // update User object
            $user = Auth::user();
            if (!empty($reqParams['profile_photo']) || !empty($reqParams['profile_photo_url'])) {
                // update Profile photo
                $user->profile_photo_path = $this->uploadOrRmovePhotoOfField('profile_photo', $request);
            }
            $user->update($reqParams);

            $response['user'] = $user;
            return $this->sendResponse($response, Response::HTTP_OK);
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
    public function resetPasswordUsingCurrentPassword(Request $request)
    {
        $response = [];
        $reqParams = array_filter($request->json()->all());
        try {
            // validate request
            $validationRules = [
                'current_password' => 'required',
                'new_password' => 'min:8|required',
                'confirm_password' => 'min:8|required|same:new_password',
            ];

            $validationMessages = [
                'new_password.required' => 'New Password is required.',
                'confirm_password.required' => 'Confirm Password is required.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                return $this->sendError($validator->errors(), Response::HTTP_BAD_REQUEST);
            }

            $user = Auth::user();

            if (!Hash::check($reqParams['current_password'], $user->password)) {
                $response['messages']['current_password'] = ['Existing password is not correct.',];
                return $this->sendError($response, Response::HTTP_BAD_REQUEST);
            }

            $user->password = bcrypt($reqParams['new_password']);
            $user->save();

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
            $query = User::orderBy($sort_by, $sort_order);

            //Search query by name 
            if(array_key_exists('full_name', $reqParams['filter']))
                $query->where('full_name', 'LIKE', '%'. $reqParams['filter']['full_name']. '%');
            
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
