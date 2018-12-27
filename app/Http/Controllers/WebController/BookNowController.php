<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;

class BookNowController extends Controller
{
    public function index()
    { 
        $hotelInfo = SystemVariables::all();
        return view('pages.web.BookNow.index', $hotelInfo); 
    }
    // return view('pages.Rooms.room', ['data' => $room]); 
}
