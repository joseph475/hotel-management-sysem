<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RoomsController extends Controller
{
    private $data;

    public function index()
    {   
        $data = $this->getSystemVariables();
        return view('pages.Rooms.index', $data); 

    }

}
