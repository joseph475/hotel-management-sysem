<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;
use App\Models\CheckinModel;
use App\Models\RoomModel;

class CheckinController extends Controller
{   
    public function index($id){
        $room = DashboardModel::findOrFail($id);
        if($room->status != 'Vacant'){ return redirect('/'); }
        else{ return view('pages.Checkin.index', ['data' => $room]); }
    }
    public function show($id){
        $checkinStatus = DashboardModel::select('*')->where('checkin_id', $id)->first();
        return view('pages.CheckinStatus.index', ['data' => $checkinStatus]);
    }
}
