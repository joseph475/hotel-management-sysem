<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GuestModel;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guests = GuestModel::join('checkin', 'guests.id', '=', 'checkin.guestId')
        ->join('rooms', 'rooms.id', '=', 'checkin.room_id')
        ->select('guests.id', 'guests.name', 'guests.contact', 'guests.companyName','guests.email', 'guests.companyAddress', 'rooms.roomNo','checkin.id AS checkin_id')
        ->where('checkin.isCheckIn', 1)
        ->orderBy('checkin.checkOutDate')
        ->paginate(10);
        return $guests;
    }

    public function printGuestList(){
        $variables = $this->getSystemVariables();
        $guests = GuestModel::join('checkin', 'guests.id', '=', 'checkin.guestId')
        ->join('rooms', 'rooms.id', '=', 'checkin.room_id')
        ->join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
        ->select('guests.id', 'guests.name', 'guests.contact', 'guests.companyName','guests.email', 'guests.companyAddress', 'rooms.roomNo', 'roomtypes.type','checkin.id AS checkin_id','checkin.adultsCount', 'checkin.childrenCount', 'checkin.checkInDate', 'checkin.checkOutDate')
        ->where('checkin.isCheckIn', 1)
        ->orderBy('checkin.checkOutDate')->get();

        $data = array(
            'variables' => $variables,
            'guests' => $guests
        );

        $pdf = \PDF::loadView('pdf.guestList', $data)->setOptions(['defaultFont' => 'sans-serif', 'fontHeightRatio' => '0.8']);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('guestList.pdf');
    }
    
}
