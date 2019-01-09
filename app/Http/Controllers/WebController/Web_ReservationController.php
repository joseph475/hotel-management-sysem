<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;
use Illuminate\Support\Facades\DB;

class Web_ReservationController extends Controller
{
    public function index(){
        $variables = $this->getSystemVariables();
        $roomTypes = DB::select('select A.id, A.type, A.description,A.maxAdult,
            A.maxChildren,(select filename from room_images where roomtype_id = A.id
            order by created_at desc limit 1) as img 
            from roomtypes A ORDER by A.created_at DESC limit 3');
        
        $data = [
            'variables' => $variables,
            'roomTypes' => $roomTypes
        ];
        return view('pages.web.index', $data);
    }
}
