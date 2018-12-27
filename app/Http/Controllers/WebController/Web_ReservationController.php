<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Web_ReservationController extends Controller
{
    public function index(){
        return view('pages.web.index');
    }
}
