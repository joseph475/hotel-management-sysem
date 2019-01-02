<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;

class Web_ReservationController extends Controller
{
    public function index(){
        $variables = $this->getSystemVariables();

        // $roomTypes = RoomTypeModel::leftJoin('room_images', 'roomtypes.id', '=', 'room_images.roomtype_id')
        // ->orderby('roomtypes.created_at', 'desc')
        // ->limit(3)
        // ->get();
        $roomTypes = DB::select('select A.id, A.type, A.description,A.maxAdult,
        A.maxChildren,(select filename from room_images where roomtype_id = A.id
        order by created_at desc limit 1) as img 
        from roomtypes A ORDER by A.created_at DESC limit 3');
        // print_r($roomTypes); exit;

        $data = [
            'variables' => $variables,
            'roomTypes' => $roomTypes
        ];
        return view('pages.web.index', $data);
    }
}
