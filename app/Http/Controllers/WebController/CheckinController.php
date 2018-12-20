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

class CheckinController extends Controller
{   
    public function index($id){
        $room = DashboardModel::findOrFail($id);
        if($room->status != 'Vacant'){ return redirect('/'); }
        else{ return view('pages.Checkin.index', ['data' => $room]); }
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
        ->select('menuName', 'servings', 'remaining', 'cost', 'sellingPrice')
        ->where(['checkinId'=> $id, 'ispublished' => 1])
        ->get();

        $checkinDetails = DashboardModel::select('*')->where('checkin_id', $id)->first();

        $data = array(
            'data' => $checkinDetails,
            'addedfoods' => $addedFoods,
            'foodlist' => $foodlist,
            'extraslist' => $extrasList
        );
        return view('pages.CheckinStatus.index',$data);
    }
}
