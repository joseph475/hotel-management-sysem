<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Query\Builder;
use Carbon;

class DashboardController extends Controller
{
    public function index(Request $request){
        $roomCards = DashboardModel::where('ispublished', 1)
        ->where('roomNo', 'LIKE', "%{$request->search}%")
        ->orWhere('status', 'LIKE', "%{$request->search}%")
        ->orWhere('type', 'LIKE', "%{$request->search}%")
        ->orderBy('room_id')->paginate(12);
        return $roomCards;
    }
    public function loadAvailableRooms(){
        $availableRooms = DB::select('SELECT B.type, count(*) as total FROM rooms A inner join roomTypes B on A.roomType = B.id where A.status = "Vacant" and A.ispublished = 1 group by B.type');
        return $availableRooms;
    }
    public function getForCheckout(){
        $forCheckOut = DashboardModel::whereNotNull('checkin_id')
        ->where('checkOutDate','<', Carbon::now()->addMinutes(15)->toDateTimeString())
        ->get();

        // ->toSql();
        // echo $forCheckOut->getBindings();
        // var_dump($forCheckOut->toSql());
        // var_dump($forCheckOut->getBindings());
        // exit;
        // echo $forCheckOut; exit;

        // print_r($queries); exit;
        return $forCheckOut;
    }
    public function getReserveAvailableOccupiedCount(){
        $data = DB::select(
            'Select status, count(*) as total from rooms where status = "Vacant" and ispublished = 1 GROUP by status
                UNION
             Select status, count(*) as total from rooms where status = "Occupied" and ispublished = 1 GROUP by status
                UNION
             Select status, count(*) as total from rooms where status = "Reserved" and ispublished = 1 GROUP by status
                UNION
             Select status, count(*) as total from rooms where status = "Cleaning" and ispublished = 1 GROUP by status
                UNION
             Select status, count(*) as total from rooms where status = "Maintenance" and ispublished = 1 GROUP by status');
        return $data;
    }
}
