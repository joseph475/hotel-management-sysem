<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GuestModel;
use App\Models\RoomModel;
use App\Models\CheckinModel;
use App\Models\CheckinRoomBillingModel;
use App\Models\AddedFoodsModel;
use App\Models\AddedExtrasModel;
use App\Models\KitchenModel;

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
        $remainingTime = $request->remainingTime;
        $checkout = date("Y-m-d H:i:s", strtotime("+{$remainingTime} hours"));
        // $remainingTime = "{$remainingTime}:00";
        $checkin = array(
            'room_id' => $request->room_id,
            'guestId' => $guest_id->id,
            'checkOutDate' => $checkout,
            'adultsCount' => $request->adultsCount,
            'childrenCount' => $request->childrenCount
        );

        $checkin = CheckinModel::create($checkin);
        $checkin_id = CheckinModel::select('id')->whereRaw('id = (select max(`id`) from checkin)')->first();
        $roomBilling = array(
            'checkin_id' => $checkin_id->id,
            'raterefno' => $request->raterefno
        );
        $roomBilling = CheckinRoomBillingModel::create($roomBilling);

        RoomModel::findOrFail($request->room_id)->update(['status'=>'Occupied']);
        return ($checkin)? ['status' => 1] : ['status' => 0];
    }

    public function extendTime(Request $request){
        $extendTime = CheckinRoomBillingModel::create($request->all());

        $checkin = CheckinModel::findOrFail($request->checkin_id);
        $hours = $request->hours;

        $checkout = date("Y-m-d H:i:s" , strtotime($checkin->checkOutDate . "+{$hours} hours"));
        // $checkout = date("Y-m-d H:i:s", strtotime("+{$hours} hours"));

        $checkin->checkOutDate = $checkout;
        $checkin->save();

        return $extendTime;
    }

    public function addAddedExtras(Request $request){
        $addedExtras = AddedExtrasModel::create($request->all());
        return $addedExtras;
    }
    public function addAddedFoods(Request $request){
        $addedFoods = AddedFoodsModel::create($request->all());
        $remainingFoods = KitchenModel::findOrFail($request->foodsId);
        $remainingFoods->remaining = $remainingFoods->remaining - $request->quantity;
        $remainingFoods->save();

        return $addedFoods;
    }
}
