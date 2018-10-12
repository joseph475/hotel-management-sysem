<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;

class CheckinController extends Controller
{
    public function index($id){
        $room = DashboardModel::findOrFail($id);
        return view('pages.checkin.index', ['data' => $room]); 
        // return view('pages.checkin.index', $room); 
    }
}
