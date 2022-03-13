<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryStatusReportController extends Controller
{
    public function index()
    {   
        return view('pages.admin.InventoryStatus.index'); 
    }
}
