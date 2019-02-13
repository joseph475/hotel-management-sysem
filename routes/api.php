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

Route::middleware('auth:api')->group(function(){

});

Route::get('SystemVariables','ApiController\SystemVariablesController@index');
Route::get('HotelInfo','ApiController\HotelInfoController@index');
Route::put('HotelInfo','ApiController\HotelInfoController@store');

Route::get('Rooms','ApiController\RoomsController@index');
Route::post('Room','ApiController\RoomsController@store');
Route::put('Room','ApiController\RoomsController@store');
Route::delete('Room/{id}','ApiController\RoomsController@destroy');


Route::post('RoomType','ApiController\RoomTypesController@store');
Route::post('AddRoomRate','ApiController\RoomTypesController@addRoomRate');
Route::get('RoomRate/{id}','ApiController\RoomTypesController@getRoomRate');
Route::post('image-upload', 'ApiController\RoomTypesController@upload')->name('image.upload.post');

Route::get('RoomTypes','ApiController\RoomTypesController@index');
Route::get('RoomTypes/{id}','ApiController\RoomTypesController@show');
Route::delete('RoomType/{id}','ApiController\RoomTypesController@destroy');

Route::get('Guests','ApiController\GuestsController@index');

Route::get('Kitchen','ApiController\KitchenController@index');
Route::post('Kitchen','ApiController\KitchenController@store');
Route::put('Kitchen','ApiController\KitchenController@store');
Route::delete('Kitchen/{id}','ApiController\KitchenController@destroy');

Route::get('Extras','ApiController\ExtrasController@index');
Route::post('Extra','ApiController\ExtrasController@store');
Route::put('Extra','ApiController\ExtrasController@store');
Route::delete('Extra/{id}','ApiController\ExtrasController@destroy');

Route::post('Checkin','ApiController\CheckinController@store');

Route::put('RoomManagement/update/{id}','ApiController\RoomManagementController@update');
Route::get('Rooms/getRoomsNotOccupied','ApiController\RoomsController@getRoomsNotOccupied');

Route::get('AdminReservationList','ApiController\Admin_ReservationController@index');

Route::get('dashboard','ApiController\DashboardController@index');

// web

Route::post('WebReservation','ApiController\Web_ReservationController@store');
