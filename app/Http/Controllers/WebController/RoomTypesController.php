<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;

class RoomTypesController extends Controller
{
    public function index(){
        return view('pages.admin.RoomTypes.index'); 
    }

    public function show($id){
        $roomtype = RoomTypeModel::findOrFail($id);
        $room_images = RoomImagesModel::select('id','filename','created_at')->where('roomtype_id', $id)->get();
  
        $data = array(
            'roomtype' => $roomtype,
            'room_images' => $room_images
        );
        return view('pages.admin.RoomTypes.roomtype', $data); 
    }
}
