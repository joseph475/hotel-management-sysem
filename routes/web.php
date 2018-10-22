<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Rooms', 'WebController\RoomsController@index');

Route::get('/RoomTypes', 'WebController\RoomTypesController@index');

Route::get('/Checkin/{id}', 'WebController\CheckinController@index');

Route::get('/RoomManagement', 'WebController\RoomManagementController@index');

Route::get('/Guests', 'WebController\GuestsController@index');



Route::get('/', function () {
    return view('pages.index');
});