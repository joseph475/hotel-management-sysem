<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admin_ReservationController extends Controller
{
    public function reservationList(){
        return view('pages.admin.Reservation.reservationList');
    }
    public function AddReservation(){
        return view('pages.admin.Reservation.addReservation');
    }
}
