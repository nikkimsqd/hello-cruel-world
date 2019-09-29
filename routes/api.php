<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/apiSample', function () {
    return response ()->json(['hello' => 'hello']);
});

Route::get('/authenticate/{username}/{password}', 'IonicController@authenticate');


Route::get('/getForDdeliveries', 'IonicControllerIonicController@shop');

Route::get('/ionic-topickup', 'IonicController@topickup');
Route::get('/ionic-todeliver', 'IonicController@todeliver');
Route::get('/ionic-delivered', 'IonicController@delivered');
Route::get('/ionic-completed', 'IonicController@completed');

Route::get('/ionic-viewOrder/{orderID}', 'IonicController@viewOrder');
Route::get('/ionic-pickupOrder/{data}', 'IonicController@pickupOrder');
Route::get('/ionic-deliveredOrder/{orderID}', 'IonicController@deliveredOrder');

Route::get('/courier-notifications/{userID}', 'IonicController@notifications');
Route::get('/courier-countNotifications/{userID}', 'IonicController@countNotifications');
Route::get('/courier-viewNotification/{userID}/{notificationID}', 'IonicController@viewNotification');

Route::get('/courier-countDatas/{userID}', 'IonicController@countDatas');


Route::get('/ionic-profile/{userID}', 'IonicController@profile');