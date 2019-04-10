<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;
use App\Models\CheckinModel;
use App\Models\RoomModel;
use App\Models\KitchenModel;
use App\Models\ExtrasModel;
use App\Models\AddedFoodsModel;
use App\Models\AddedExtrasModel;
use App\Models\AdditionalRoomRates;
use App\Models\CheckinRoomBillingModel;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{   
    public function index($id){
        $room = DashboardModel::findOrFail($id);
        $roomRate = AdditionalRoomRates::select('id', 'hours', 'rate')->where('roomtype_id', $room->roomtype_id)->where('hours','<','24')->orderBy('hours', 'desc')->get();
        
        $data = array(
            'room' => $room,
            'roomRate' => $roomRate
        );

        if($room->status != 'Vacant'){ return redirect('/'); }
        else{ return view('pages.admin.Checkin.index', ['data' => $data]); }
    }

    public function show($id){
        $extrasList = ExtrasModel::select('id', 'description', 'cost')
        ->where('ispublished', 1)
        ->orderby('createdDate', 'desc')
        ->get();

        $foodlist = KitchenModel::select('id', 'menuName', 'servings', 'remaining', 'cost', 'sellingPrice')
        ->where('ispublished', 1)
        ->where('remaining', '>', 0)
        ->orderby('createdDate', 'desc')
        ->get();

        // $addedFoods = AddedFoodsModel::join('foods', 'addedfoods.foodsId', '=', 'foods.id')
        // ->select('foods.id','menuName', 'servings', 'remaining', 'cost', 'sellingPrice', 'quantity')
        // ->where(['checkinId'=> $id, 'ispublished' => 1])
        // ->groupby(['foods.id','foods.menuName', 'foods.servings', 'foods.remaining','foods.cost', 'foods.sellingPrice','addedfoods.quantity'])
        // ->get();

        $addedFoods = DB::select('Select sum(quantity) as quantity, foodsId as id,
            (select menuName from foods where id = A.foodsId) as menuName,
            (select cost from foods where id = A.foodsId) as cost,
            (select sellingPrice from foods where id = A.foodsId) as sellingPrice,
            (select remaining from foods where id = A.foodsId) as remaining
            from addedFoods A where A.checkinId = '. $id .' group by A.foodsId');

        // $addedExtras = AddedExtrasModel::join('extras', 'addedextras.extrasId', '=', 'extras.id')
        // ->select('extras.id', 'description', 'cost', 'quantity')
        // ->where(['checkinId'=> $id, 'ispublished' => 1])
        // ->groupby(['extras.id', 'description', 'cost', 'quantity'])
        // ->get();

        $addedExtras = DB::select('Select sum(quantity) as quantity, extrasId as id, (select description from extras where id = A.extrasId) as description,
        (select cost from extras where id = A.extrasId) as cost from addedextras A where A.checkinId = '. $id .' group by A.extrasId');

        $roomBilling = CheckinRoomBillingModel::join('roomtype_additional_rates', 'checkin_table_room_billing.raterefno', '=', 'roomtype_additional_rates.id')
        ->select('rate', 'hours')
        ->where(['checkin_id'=> $id])
        ->get();

        $checkinDetails = DashboardModel::select('*')->where('checkin_id', $id)->first();

        $roomRate = AdditionalRoomRates::select('id', 'hours', 'rate')->where('roomtype_id', $checkinDetails->roomtype_id)->orderBy('hours', 'desc')->get();

        $totalRoom =  DB::select('Select sum((select rate from roomtype_additional_rates where id = raterefno)) as rate
            from checkin_table_room_billing where checkin_id = '. $id .' GROUP by checkin_id');

        $totalFoods = DB::select('select sum(price) as price 
            from ( select (select sellingPrice from foods where id = foodsId) * sum(quantity) as price
            from addedfoods where checkinId = 1 GROUP By foodsId ) as t1');

        $totalExtras = DB::select('select sum(price) as price 
            from ( select (select cost from extras where id = extrasId) * sum(quantity) as price
            from addedextras where checkinId = 1 GROUP By extrasId ) as t1');

        //  print_r($totalFoods[0]->price); exit;
        $data = array(
            'data' => $checkinDetails,
            'addedfoods' => $addedFoods,
            'addedextras' => $addedExtras,
            'foodlist' => $foodlist,
            'extraslist' => $extrasList,
            'roombilling' => $roomBilling,
            'roomRates' => $roomRate,
            'totalRoom' => $totalRoom,
            'totalFoods' => $totalFoods,
            'totalExtras' => $totalExtras
        );
        return view('pages.admin.CheckinStatus.index',$data);
    }
    
}
