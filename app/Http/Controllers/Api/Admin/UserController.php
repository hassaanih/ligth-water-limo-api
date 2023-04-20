<?php

namespace App\Http\Controllers\Api\Admin;

use App\Enums\UserStatus;
use App\Helper\CommonHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends BaseController
{
    /**
     * Sign in API
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        try {
            // TODO :: array_filter replace with our custom array filter createdd recently in some project
            $reqParams = array_filter($request->all());
            $reqParams = CommonHelper::filterEmptyValues($request->all());
            $validationMessages = [
                'email.required' => 'Email is required.',
                'password.required' => 'Password is required.',
            ];

            $validationRules = [
                'email' => 'required',
                'password' => 'required',
            ];

            $validator = Validator::make(
                $reqParams,
                $validationRules,
                $validationMessages
            );

            if ($validator->fails()) {
                return $this->sendError(
                    $validator->errors(),
                    Response::HTTP_BAD_REQUEST
                );
            }

            // validate credentials
            if (
                !Auth::attempt([
                    'email' => $reqParams['email'],
                    'password' => $reqParams['password'],
                ])
            ) {
                return $this->sendError(
                    ['general' => ['The combination of user ID and password entered is invalid.']],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $user = Auth::user();
            if ($user->status == UserStatus::INACTIVE) {
                $response['general'] = ['Account is inactive. Please contact support.'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
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
            return $this->sendError(
                ['errors' => [$e->getMessage()]],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Sign out API
     *
     * @return \Illuminate\Http\Response
     */
    public function signout(Request $request)
    {
        if ($request->user()) {
            $request->currentAccessToken()->delete();
        }
        return $this->sendResponse(null);
    }
}
