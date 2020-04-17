<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryListController extends Controller
{
    public function index()
    {   
        return view('pages.admin.InventoryList.index'); 
    }
}
