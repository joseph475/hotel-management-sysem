<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;
use App\Models\RoomInventoryModel;
use App\Models\RoomInventoryCategoryModel;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    private $data;

    public function index()
    {   
        $data = $this->getSystemVariables();
        return view('pages.admin.Rooms.index', $data); 
    }

    public function showInventory($id){
        // $data = $this->getSystemVariables();
        $inventory = DB::select('select description, 
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 1) as good,
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 2) as damaged,
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 3) as missing
        from inventory_category A');

        $data = array(
            'inventory' => $inventory,
            'roomNo' => $id,
        );
        // print_r($data); exit;
        return view('pages.admin.Rooms.inventory', $data); 
    }

    // public function show($id){
    //     $room = RoomModel::join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
    //     ->select('rooms.id', 'rooms.roomNo', 'roomtypes.type', 'rooms.floor', 'roomtypes.rate', 'roomtypes.rateperhour','rooms.status','rooms.ispublished')
    //     ->findOrFail($id);
    //     return view('pages.Rooms.room', ['data' => $room]); 
    // }
}
