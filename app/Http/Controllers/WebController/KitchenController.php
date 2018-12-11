<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KitchenController extends Controller
{
    public function index()
    {   
        return view('pages.Kitchen.index'); 
    }
}
