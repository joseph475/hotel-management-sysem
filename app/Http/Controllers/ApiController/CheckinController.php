<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GuestModel;
use App\Models\RoomModel;
use App\Models\CheckinModel;

class CheckinController extends Controller
{
    
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $guest = GuestModel::create($request->all());
        $guest_id = GuestModel::select('id')->whereRaw('id = (select max(`id`) from guests)')->first();
        
        $checkout = $request->checkOutDate;
        $checkout = date('Y-m-d H:i:s' , strtotime($checkout));

        $checkin = array(
            'room_id' => $request->room_id,
            'guestId' => $guest_id->id,
            'checkOutDate' => $checkout,
            'adultsCount' => $request->adultsCount,
            'childrenCount' => $request->childrenCount
        );

        $checkin = CheckinModel::create($checkin);
        RoomModel::findOrFail($request->room_id)->update(['status'=>'Occupied']);
        return ($checkin)? ['status' => 1] : ['status' => 0];
    }

  
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
