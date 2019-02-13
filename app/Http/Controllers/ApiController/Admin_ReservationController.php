<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use Illuminate\Support\Facades\DB;

class Admin_ReservationController extends Controller
{
    public function index(){
        // $reservationList = ReservationModel::orderBy('reservationDate', 'asc')
        // ->paginate(10);
        // return $reservationList;
        
        $reservationList = DB::select('Select A.id, personal_id, personal_id_type, B.type,
        name, mobile, email, compName, compAddress, checkInDate, adultsCount, childrensCount, reservationDate
        from reservations A inner join roomtypes B on A.roomtype = B.id');

        return ['data' => $reservationList];

    }
}
