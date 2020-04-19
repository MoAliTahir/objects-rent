<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/user', 'LoginController@listUser');

Route::group([

    'middleware' => 'jwt',
    'prefix' => 'auth'

], function ($router) {


    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('payload', 'AuthController@payload');

});

Route::post('login', 'AuthController@login');


Route::get('user-details/{id}', 'AdminController@userDetails')->middleware('admin');


Route::group([

    'prefix' => 'partner'

], function ($router) {


    Route::get('item', 'PartnerController@itemList');
    Route::get('item/{id}', 'PartnerController@itemDetails');
    Route::post('item', 'PartnerController@newItem');
    Route::patch('item/{id}', 'PartnerController@updateItem');
    Route::delete('item/{id}', 'PartnerController@deleteItem');

});


