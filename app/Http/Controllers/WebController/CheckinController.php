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

class CheckinController extends Controller
{   
    public function index($id){
        $room = DashboardModel::findOrFail($id);
        // echo "<pre>"; print_r($room->roomtype_id); exit;
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

        $addedFoods = AddedFoodsModel::join('foods', 'addedfoods.foodsId', '=', 'foods.id')
        ->select('foods.id','menuName', 'servings', 'remaining', 'cost', 'sellingPrice', 'quantity')
        ->where(['checkinId'=> $id, 'ispublished' => 1])
        ->get();

        $addedExtras = AddedExtrasModel::join('extras', 'addedextras.extrasId', '=', 'extras.id')
        ->select('extras.id', 'description', 'cost', 'quantity')
        ->where(['checkinId'=> $id, 'ispublished' => 1])
        ->get();

        $checkinDetails = DashboardModel::select('*')->where('checkin_id', $id)->first();

        $data = array(
            'data' => $checkinDetails,
            'addedfoods' => $addedFoods,
            'addedextras' => $addedExtras,
            'foodlist' => $foodlist,
            'extraslist' => $extrasList
        );
        return view('pages.admin.CheckinStatus.index',$data);
    }
}
