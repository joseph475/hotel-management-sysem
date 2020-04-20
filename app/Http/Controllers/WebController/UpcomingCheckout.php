<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpcomingCheckout extends Controller
{
    public function index()
    {   
        return view('pages.admin.UpcomingCheckout.index'); 
    }
}
