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

    //Menu Items
    Route::post('event/{id}/menu/menu_item', ['as'=>'event.{id}.menu.store','uses'=>'MenuItemController@store']);
    Route::get('event/{id}/menu/menu_items', ['as'=>'event.{id}.menu.menu_item.index','uses'=>'MenuItemController@index']);
    Route::get('event/{id}/menu/menu_item/{item_id}', ['as'=>'event.{id}.menu.menu_item.{item_id}.show','uses'=>'MenuItemController@show']);
    Route::put('event/{id}/menu/menu_item/{item_id}', ['as'=>'event.{id}.menu.menu_item.{item_id}.update','uses'=>'MenuItemController@update']);
    Route::delete('event/{id}/menu/menu_item/{item_id}', ['as'=>'event.{id}.menu.menu_item.{item_id}.delete','uses'=>'MenuItemController@destroy']);

    //Room
    Route::post('event/{id}/room/', ['as'=>'event.{id}.room.store','uses'=>'RoomController@store']);
    Route::get('event/{id}/room/', ['as'=>'event.{id}.room.show','uses'=>'RoomController@show']);
    Route::put('event/{id}/room/', ['as'=>'event.{id}.room.update','uses'=>'RoomController@update']);
    Route::delete('event/{id}/room/', ['as'=>'event.{id}.room.delete','uses'=>'RoomController@destroy']);

    //Tables
    Route::post('event/{id}/room/table', ['as'=>'event.{id}.room.store','uses'=>'TableController@store']);
    Route::get('event/{id}/room/tables', ['as'=>'event.{id}.room.table.index','uses'=>'TableController@index']);
    Route::get('event/{id}/room/table/{table_id}/guests', ['as'=>'event.{id}.room.table.index','uses'=>'TableController@tableGuests']);
    Route::get('event/{id}/room/table/{table_id}', ['as'=>'event.{id}.room.table.{table_id}.show','uses'=>'TableController@show']);
    Route::put('event/{id}/room/table/{table_id}', ['as'=>'event.{id}.room.table.{table_id}.update','uses'=>'TableController@update']);
    Route::delete('event/{id}/room/table/{item_id}', ['as'=>'event.{id}.room.table.{item_id}.delete','uses'=>'TableController@destroy']);
    Route::put('event/{id}/room/table/{table_id}/seat_guest', ['as'=>'event.{id}.room.seatGuest','uses'=>'TableController@seatGuest']);
    Route::put('event/{id}/room/table/{table_id}/remove_guest', ['as'=>'event.{id}.room.removeGuest','uses'=>'TableController@removeGuest']);
});
