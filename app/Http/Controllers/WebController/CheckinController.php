<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckinController extends Controller
{
    public function index($id){
        $data = $this->getSystemVariables();
        return view('pages.checkin.index', $data); 

    }
}
