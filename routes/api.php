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

/**
 * Use this on generic routes which only require the auth:api middleware
 * A good practice would be to use $this->middleware on the Controller
 * constructor itself
 */
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::resource('/logs', 'Log\LogController');
Route::resource('/users', 'User\UserController');
Route::resource('/oauth', 'OauthController');

/**
 * Override the default outh/token to also use this api middleware
 */
Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
