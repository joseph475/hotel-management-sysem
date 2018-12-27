<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotelInfoController extends Controller
{
    public function index()
    { 
        return view('pages.admin.HotelInfo.index'); 
    }
    // return view('pages.Rooms.room', ['data' => $room]); 
}
