<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;

class BookNowController extends Controller
{
    public function index()
    { 
        $variables = $this->getSystemVariables();
        $hotelInfo = SystemVariables::all();

        $data = [
            'variables' => $variables,
            'hotelInfo' => $hotelInfo
        ];

        return view('pages.web.BookNow.index', $data); 
    }
    // return view('pages.Rooms.room', ['data' => $room]); 
}
