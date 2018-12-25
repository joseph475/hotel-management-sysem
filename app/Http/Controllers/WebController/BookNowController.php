<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookNowController extends Controller
{
    public function index()
    { 
        return view('pages.BookNow.index'); 
    }
    // return view('pages.Rooms.room', ['data' => $room]); 
}
