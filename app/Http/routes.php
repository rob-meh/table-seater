<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::post('/api/authenticate', 'Api\ApiAuthController@authenticate');
Route::group(['prefix'=>'api','middleware'=>'jwt.auth'],function(){

    Route::resource('event','EventController',['except'=>['create','edit']]);
    Route::get('event/{id}/menu/','EventController@getMenu');
    Route::get('event/{id}/room/','EventController@getRoom');
    Route::get('event/{id}/guest_list/','EventController@getGuestList');

});
