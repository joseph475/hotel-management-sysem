<?php

namespace App\Http\Controllers\Webcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {   
        return view('pages.admin.Collection.index'); 
    }
}
