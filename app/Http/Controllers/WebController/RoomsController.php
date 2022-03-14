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

    public function show($id){
        $inventory = DB::select('select id,description, 
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 1 and roominventory.room_id ='. $id .') as good,
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 2 and roominventory.room_id ='. $id .') as damaged,
        (select count(id) from roominventory where A.id = roominventory.inventory_id and roominventory.status = 3 and roominventory.room_id ='. $id .') as missing
        from inventory_category A');

        $availableInventory = DB::select('select id,description from inventory_category where ispublished = 1');

        $data = array(
            'inventory' => $inventory,
            'roomNo' => $id,
            'availableInventory' => $availableInventory,
        );
        // print_r($data); exit;
        return view('pages.admin.Rooms.inventory', $data); 
    }
}
