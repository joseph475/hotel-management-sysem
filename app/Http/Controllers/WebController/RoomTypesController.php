<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypesController extends Controller
{
    public function index(){
        return view('pages.RoomTypes.index'); 
    }
}
