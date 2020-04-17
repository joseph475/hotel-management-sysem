<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use App\Models\RoomModel;
use App\Models\AdditionalRoomRates;
use App\Models\CheckinModel;
use App\Models\GuestModel;
use App\Models\CheckinRoomBillingModel;
use App\Models\BillingModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class Admin_ReservationController extends Controller
{
    public function index(Request $request){
        
        $reservationList = ReservationModel::join('roomtypes', 'reservations.roomType', '=', 'roomtypes.id')
        ->select('reservations.id', 'personal_id','personal_id_type', 'roomtypes.type',
         'roomtypes.id as roomTypeId','name', 'mobile', 'email', 'compName', 'compAddress',
          'checkInDate', 'adultsCount', 'childrensCount', 'reservationDate')
        ->where('status', 'Pending')
        ->where('name', 'LIKE', "%{$request->search}%")
        ->orderBy('reservations.reservationDate', 'asc')
        ->paginate(10);

        return $reservationList;
    }

    public function getRoomRates($roomTypeId){
        $roomRates = AdditionalRoomRates::select('id', 'hours', 'rate')->where('roomtype_id', $roomTypeId)->orderBy('hours', 'asc')->get();
        return $roomRates;
    }

    public function getAvailableRooms(Request $request){
        $availableRooms = RoomModel::select('rooms.id', 'rooms.roomNo', 'rooms.floor')
        ->where(['ispublished' => 1, 'status' => 'Vacant', 'roomType' => $request->roomTypeId])
        ->get();

        
        $roomRates = $this->getRoomRates($request->roomTypeId);

        $data = array(
            'availableRooms' => $availableRooms,
            'roomRates' => $roomRates
        );

        return $data;
    }
    public function cancelForCheckinReservation(Request $request){
        $room = ReservationModel::findOrFail($request->reservationId);
        $reservation = ReservationModel::findOrFail($request->reservationId)->update(['status'=>'Cancelled']);
        $roomStatus = RoomModel::findOrFail($room->room_id)->update(['status'=>'Vacant']);
        return [];
    }
    public function cancelPendingReservation(Request $request){
        $reservation = ReservationModel::findOrFail($request->reservationId)->update(['status'=>'Cancelled']);
        return [];
    }
    public function reserve(Request $request){
        // print_r($request->roomId); exit;
        $reserve = ReservationModel::findOrFail($request->reservationId)->update(['status'=>'Reserved', 'room_id'=>$request->roomId]);
        $roomStatus = RoomModel::findOrFail($request->roomId)->update(['status'=>'Reserved']);
        return [];
    }
    public function getReservedRooms(Request $request){
        $availableRooms = ReservationModel::join('roomtypes', 'reservations.roomType', '=', 'roomtypes.id')
        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
        ->join('roomtype_additional_rates', 'reservations.rate_id', '=', 'roomtype_additional_rates.id')
        ->select('reservations.id','reservations.room_id','rooms.roomNo', 'roomtypes.type','reservations.rate_id as rate_id', 'roomtype_additional_rates.hours',
         'reservations.days','roomtypes.id as roomTypeId','name', 'mobile', 'email', 'compName', 'compAddress', 'adultsCount',
          'childrensCount')
        ->where('reservations.status', 'Reserved')
        ->where('name', 'LIKE', "%{$request->search}%")
        ->orderBy('reservations.reservationDate', 'asc')
        ->paginate(10);

        return $availableRooms;
    }

    public function checkInReservation(Request $request){
        
        $reservation = ReservationModel::findOrFail($request->reservationId);
        
        
        $guest = array(
            'name' => $reservation->name,
            'contact' => $reservation->mobile,
            'email' => $reservation->email,
            'companyName' => $reservation->compName,
            'companyAddress' => $reservation->compAddress,
        );
        
        try {
            $guest = GuestModel::create($guest);
        }
        catch (QueryException $e) {
            return dd($e->getMessage());
        }
       
        $guest_id = GuestModel::select('id')->whereRaw('id = (select max(`id`) from guests)')->first();
        

        $basicHourfromRates = AdditionalRoomRates::findOrFail($reservation->rate_id, ['hours']);
        $basicHourfromRates = $basicHourfromRates->hours;

        $duration = ($reservation->days != 0)?  $basicHourfromRates * $reservation->days : $basicHourfromRates;

        $checkout = date("Y-m-d H:i:s", strtotime("+{$duration} hours"));

        $checkin = array(
            'room_id' => $reservation->room_id,
            'guestId' => $guest_id->id,
            'checkOutDate' => $checkout,
            'adultsCount' => $reservation->adultsCount,
            'childrenCount' => $reservation->childrensCount
        );
        
        try {
            $checkin = CheckinModel::create($checkin);
        }
        catch (QueryException $e) {
            return dd($e->getMessage());
        }

        $checkin_id = CheckinModel::select('id')->whereRaw('id = (select max(`id`) from checkin)')->first();

        $roomBilling = array(
            'checkin_id' => $checkin_id->id,
            'rate_id' => $reservation->rate_id,
            'days' => $reservation->days
        );
        
        $generateOR = array(
            'checkInId' => $checkin_id->id
        );

        BillingModel::create($generateOR);   
        try {
            $roomBilling = CheckinRoomBillingModel::create($roomBilling);
        }
        catch (QueryException $e) {
            return dd($e->getMessage());
        }
        
        RoomModel::findOrFail($reservation->room_id)->update(['status'=>'Occupied']);
        ReservationModel::findOrFail($request->reservationId)->update(['status'=>'Checked_In']);

        return [];
    }
}
