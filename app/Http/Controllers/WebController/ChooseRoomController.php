<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;
use App\Models\RoomTypeModel;
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
        
        $data = [
            'variables' => $variables,
            'roomtypes' => $roomtypes
        ];
        return view('pages.web.ChooseRoomType.index', $data);
    }
}
