<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;

class RoomTypesController extends Controller
{
    public function index(){
        return view('pages.RoomTypes.index'); 
    }

    public function show($id){
        $roomtype = RoomTypeModel::findOrFail($id);
        return view('pages.RoomTypes.roomtype', ['data' => $roomtype]); 
    }
}
