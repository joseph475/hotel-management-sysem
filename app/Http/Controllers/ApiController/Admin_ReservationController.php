<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use Illuminate\Support\Facades\DB;

class Admin_ReservationController extends Controller
{
    public function index(){
        
        $reservationList = DB::select('Select A.id, personal_id, personal_id_type, B.type, B.id as roomTypeId,
        name, mobile, email, compName, compAddress, checkInDate, adultsCount, childrensCount, reservationDate
        from reservations A inner join roomtypes B on A.roomtype = B.id');

        return ['data' => $reservationList];
    }

    public function getAvailableRooms(Request $request){
        $availableRooms = RoomModel::select('rooms.id', 'rooms.roomNo', 'rooms.floor')
        ->where(['ispublished' => 1, 'status' => 'Vacant', 'roomType' => $request->roomTypeId])
        ->get();
        return $availableRooms;
    }
}
