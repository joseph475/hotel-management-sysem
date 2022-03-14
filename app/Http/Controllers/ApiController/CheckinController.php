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
use App\Models\AdditionalRoomRates;
use App\Models\BillingModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckinController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $guest = array(
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'companyName' => $request->companyName,
            'companyAddress' => $request->companyAddress
        );

        $guest = GuestModel::create($guest);
        $guest_id = GuestModel::select('id')->whereRaw('id = (select max(`id`) from guests)')->first();

        $basicHourfromRates = AdditionalRoomRates::findOrFail($request->rate_id, ['hours']);
        $basicHourfromRates = $basicHourfromRates->hours;
        $duration = ($request->days != 0)?  $basicHourfromRates * $request->days : $basicHourfromRates;

        $checkout = date("Y-m-d H:i:s", strtotime("+{$duration} hours"));

        // $remainingTime = $request->remainingTime;
        // $checkout = date("Y-m-d H:i:s", strtotime("+{$remainingTime} hours"));
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
            'rate_id' => $request->rate_id,
            'days' => $request->days
        );

        $generateOR = array(
            'checkInId' => $checkin_id->id
        );

        BillingModel::create($generateOR);
        $roomBilling = CheckinRoomBillingModel::create($roomBilling);

        RoomModel::findOrFail($request->room_id)->update(['status'=>'Occupied']);
        return ($checkin)? ['status' => 1] : ['status' => 0];
    }

    public function extendTime(Request $request)
    {
        $extendTime = CheckinRoomBillingModel::create($request->all());

        $checkin = CheckinModel::findOrFail($request->checkin_id);
        $hours = $request->hours;

        $checkout = date("Y-m-d H:i:s", strtotime($checkin->checkOutDate . "+{$hours} hours"));
        // $checkout = date("Y-m-d H:i:s", strtotime("+{$hours} hours"));

        $checkin->checkOutDate = $checkout;
        $checkin->save();

        return $extendTime;
    }

    public function addAddedExtras(Request $request)
    {
        $addedExtras = AddedExtrasModel::create($request->all());
        return $addedExtras;
    }
    public function addAddedFoods(Request $request)
    {
        $addedFoods = AddedFoodsModel::create($request->all());
        $remainingFoods = KitchenModel::findOrFail($request->foodsId);
        $remainingFoods->remaining = $remainingFoods->remaining - $request->quantity;
        $remainingFoods->save();

        return $addedFoods;
    }

    public function checkout($id)
    {
        $variables = $this->getSystemVariables();
        $foods = DB::select('Select * from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = '. $id);
        $extras = DB::select('Select * from addedextras A inner join extras B on A.extrasId = B.id where A.checkinId = '. $id);
        $room = DB::select('Select *, A.created_at as checkin_date from checkin_table_room_billing A inner join roomtype_additional_rates B on A.rate_id = B.id where A.checkin_Id = '. $id);
        $info = DB::select('Select * from vw_dashboard_room_list A inner join billing B on A.checkin_id = B.checkInId where A.checkin_id = ' . $id);
        
        // print_r($info);
        // exit;
        $checkinDate =  date_create($room[0]->checkin_date);
        $diff = date_diff($checkinDate, Carbon::now());

        $hours = $diff->format("%h");
        $days = $diff->format("%d");

        // print_r($days);
        // exit;
        if ($days > 0) {
            $totalRoom =  DB::select('Select rate from roomtype_additional_rates A inner join checkin_table_room_billing B 
                on A.id = B.rate_id 
                where checkin_id = '. $id .' GROUP by checkin_id, A.rate');
            $totalRoom  = $totalRoom[0]->rate * $days;
        } else {
            $totalRoom =  DB::select('Select rate from roomtype_additional_rates A inner join checkin_table_room_billing B 
            on A.id = B.rate_id 
            where checkin_id = '. $id .' GROUP by checkin_id, A.rate');
            $totalRoom  = $totalRoom[0]->rate;
        }

    
        // $totalRoom =  DB::select('Select
        //     Sum((CASE WHEN days > 0 then
        //             (select rate from roomtype_additional_rates where id = rate_id) * days
        //         ELSE
        //             (select rate from roomtype_additional_rates where id = rate_id)
        //     End)) as rate
        //     from checkin_table_room_billing where checkin_id = '. $id .' GROUP by checkin_id');

        $totalFoods = DB::select('select sum(price) as price 
            from ( select (select sellingPrice from foods where id = foodsId) * sum(quantity) as price
            from addedfoods where checkinId = '. $id .' GROUP By foodsId ) as t1');

        $totalExtras = DB::select('select sum(price) as price 
            from ( select (select cost from extras where id = extrasId) * sum(quantity) as price
            from addedextras where checkinId = '. $id .' GROUP By extrasId ) as t1');
        
        $othersTotal = $totalFoods[0]->price + $totalExtras[0]->price;
        // $roomsTotal = $totalRoom;
        $grandTotal = $totalRoom + $totalFoods[0]->price + $totalExtras[0]->price;
     
        // update checkin table to checkout
        $checkin = CheckinModel::findOrFail($id);
        $actual_checkout =  date("Y-m-d H:i:s");
        $checkin->actual_checkout = $actual_checkout;
        $checkin->isCheckIn = 0;

        // update room status
        $room_status = RoomModel::findOrFail($checkin->room_id);
        $room_status->status = 'Cleaning';

        // update billing table
        $billing = BillingModel::select('*')->where('checkInId', $id)->first();
        $billing->date_collected = date("Y-m-d H:i:s");
        $billing->others = $othersTotal;
        $billing->room = $totalRoom;
        $billing->collection = $grandTotal;

        $checkin->save();
        $room_status->save();
        $billing->save();
     
        $data = array(
            'variables' => $variables,
            'foods' => $foods,
            'extras' => $extras,
            'rooms' => $room,
            'info' => $info,
            'totalRoom' => $totalRoom,
            'totalFoods' => $totalFoods,
            'totalExtras' => $totalExtras,
            'grandTotal' => $grandTotal,
            'days' => $days,
            'hours' => $hours,
        );

        // echo $grandTotal; exit;
        // echo "<pre>"; print_r($data); exit;
        $pdf = \PDF::loadView('pdf.receipt', $data)->setOptions(['defaultFont' => 'sans-serif', 'fontHeightRatio' => '0.8']);


        return $pdf->stream('receipt.pdf');
        // return $request->checkin_id;
    }
}
