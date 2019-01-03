<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;
use App\Models\RoomModel;

class ChooseRoomController extends Controller
{
    public function index()
    { 
        $rooms = RoomModel::join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
        ->select('rooms.id', 'rooms.roomNo', 'roomtypes.type', 'rooms.floor', 'roomtypes.rate', 'roomtypes.rateperhour','rooms.status','rooms.ispublished')
        ->orderBy('rooms.created_at', 'desc')
        ->paginate(10);
        
        return view('pages.web.Rooms.index', $rooms); 
    }
}
