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

	//Event
    Route::resource('event','EventController',['except'=>['create','edit']]);

    //Menu
    Route::post('event/{id}/menu/', ['as'=>'event.{id}.menu.store','uses'=>'MenuController@store']);
    Route::get('event/{id}/menu/', ['as'=>'event.{id}.menu.show','uses'=>'MenuController@show']);
    Route::put('event/{id}/menu/', ['as'=>'event.{id}.menu.update','uses'=>'MenuController@update']);
    Route::delete('event/{id}/menu/', ['as'=>'event.{id}.menu.delete','uses'=>'MenuController@destroy']);

});
