<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;

class RoomTypesController extends Controller
{
    public function index(){
        return view('pages.RoomTypes.index'); 
    }

    public function show($id){
        $roomtype = RoomTypeModel::findOrFail($id);
        $room_images = RoomImagesModel::select('id','filename','date_created')->where('roomtype_id', $id)->get();
  
        $data = array(
            'roomtype' => $roomtype,
            'room_images' => $room_images
        );
        return view('pages.RoomTypes.roomtype', $data); 
    }
}
