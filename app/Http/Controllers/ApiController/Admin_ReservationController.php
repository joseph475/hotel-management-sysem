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
        
        $reservationList = ReservationModel::join('roomtypes', 'reservations.roomType', '=', 'roomtypes.id')
        ->select('reservations.id', 'personal_id','personal_id_type', 'roomtypes.type',
         'roomtypes.id as roomTypeId','name', 'mobile', 'email', 'compName', 'compAddress',
          'checkInDate', 'adultsCount', 'childrensCount', 'reservationDate')
        ->where('status', 'Pending')
        ->orderBy('reservations.reservationDate', 'asc')
        ->paginate(10);

        return $reservationList;
    }

    public function getAvailableRooms(Request $request){
        $availableRooms = RoomModel::select('rooms.id', 'rooms.roomNo', 'rooms.floor')
        ->where(['ispublished' => 1, 'status' => 'Vacant', 'roomType' => $request->roomTypeId])
        ->get();
        return $availableRooms;
    }
}
