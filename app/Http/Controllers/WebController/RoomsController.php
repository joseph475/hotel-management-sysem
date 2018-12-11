<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;

class RoomsController extends Controller
{
    private $data;

    public function index()
    {   
        $data = $this->getSystemVariables();
        return view('pages.Rooms.index', $data); 
    }

    public function show($id){
        $room = RoomModel::join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
        ->select('rooms.id', 'rooms.roomNo', 'roomtypes.type', 'rooms.floor', 'roomtypes.rate', 'roomtypes.rateperhour','rooms.status','rooms.ispublished')
        ->findOrFail($id);
        return view('pages.Rooms.room', ['data' => $room]); 
    }
}
