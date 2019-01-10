<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;
use Illuminate\Support\Facades\DB;

class ChooseRoomController extends Controller
{
    public function index()
    {   
        $variables = $this->getSystemVariables();
        $roomtypes = DB::select('select A.id, A.type, A.description,A.maxAdult,
            A.maxChildren,(select filename from room_images where roomtype_id = A.id
            order by created_at desc limit 1) as img 
            from roomtypes A ORDER by A.created_at DESC');
            
        $room_images = RoomImagesModel::all();

        $data = [
            'variables' => $variables,
            'roomtypes' => $roomtypes,
            'room_images' => $room_images
        ];

        // echo"<pre>"; print_r($room_images); exit;
        return view('pages.web.ChooseRoomType.index', $data);
    }
}
