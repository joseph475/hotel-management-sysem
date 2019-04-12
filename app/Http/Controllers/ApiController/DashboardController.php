<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $roomCards = DashboardModel::where('ispublished', 1)->orderBy('room_id')->paginate(12);
        return $roomCards;
    }
    public function loadAvailableRooms(){
        $availableRooms = DB::select('SELECT B.type, count(*) as total FROM rooms A inner join roomTypes B on A.roomType = B.id where A.status = "Vacant" and A.ispublished = 1 group by B.type');
        return $availableRooms;
    }
    public function loadReserveAndAvailableCount(){
        $data = DB::select(
            'Select status, count(*) as total from rooms where status = "Vacant" and ispublished = 1 GROUP by status
            UNION
            Select status, count(*) as total from rooms where status = "Reserved" and ispublished = 1 GROUP by status');
        return $data;
    }
}
