<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestsController extends Controller
{
    public function index()
    {   
        return view('pages.Guests.index'); 
    }
}
