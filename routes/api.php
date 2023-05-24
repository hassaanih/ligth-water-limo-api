<?php

use App\Http\Controllers\Api\Web\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// App Lookup List
Route::post('lookupcountry/list', 'App\Http\Controllers\Api\Common\LookupCountryController@list');
Route::post('lookupstate/list', 'App\Http\Controllers\Api\Common\LookupStateController@list');
Route::post('lookupcity/list', 'App\Http\Controllers\Api\Common\LookupCityController@list');

Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::post('findall', 'findAll');
    Route::post('create', 'create');
    Route::post('signin', 'signin');
    Route::get('signout', 'signout');
    Route::get('sendemailotp/{id}', 'sendEmailOtp');
    Route::post('verifyemailotp', 'verifyEmailOtp');
    Route::get('sendmobileotp/{id}', 'sendMobileOtp');
});

Route::post('send/response/list', 'App\Http\Controllers\Api\Web\TodoController@postList');
Route::get('send/response/{responseCode}', 'App\Http\Controllers\Api\Web\TodoController@getList');

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('user/update', 'App\Http\Controllers\Api\Web\UserController@update');
    Route::post('user/resetpasswordusingcurrent', 'App\Http\Controllers\Api\Web\UserController@resetPasswordUsingCurrentPassword');
});

Route::post('booking/details/create', 'App\Http\Controllers\Api\Web\BookingController@createBookingDetails');
Route::post('booking/create', 'App\Http\Controllers\Api\Web\BookingController@createBooking');
Route::post('booking/vehicle/select', 'App\Http\Controllers\Api\Web\BookingController@selectVehicle');
Route::get('vehicles/find/all', 'App\Http\Controllers\Api\Web\LookupVehiclesController@findAll');
Route::get('testapi', 'App\Http\Controllers\Api\Web\BookingController@test');
Route::get('test', 'App\Http\Controllers\Api\Web\TodoController@testStripe');
Route::get('test/email', 'App\Http\Controllers\Api\Web\TodoController@testEmail');
Route::get('bookings/findAll', 'App\Http\Controllers\Api\Web\BookingController@findAll');
Route::get('bookings/find', 'App\Http\Controllers\Api\Web\BookingController@find');
Route::post('bookings/assign/driver', 'App\Http\Controllers\Api\Web\BookingController@assignDriver');
Route::post('bookings/assign/self', 'App\Http\Controllers\Api\Web\BookingController@assignSelf');
Route::post('bookings/cancel', 'App\Http\Controllers\Api\Web\BookingController@cancel');
