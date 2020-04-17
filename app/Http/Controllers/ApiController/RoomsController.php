<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;
use App\Models\CheckinModel;
use App\Models\CheckOutModel;
use App\Models\RoomInventoryModel;
use Illuminate\Support\Facades\DB;

class RoomsController extends Controller
{
    /**  
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = RoomModel::join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
        ->select('rooms.id', 'rooms.roomNo', 'roomtypes.type', 'rooms.floor', 'roomtypes.rateperhour','rooms.status','rooms.ispublished')
        ->where('rooms.roomNo', 'LIKE', "%{$request->search}%")
        ->orWhere('roomtypes.type', 'LIKE', "%{$request->search}%")
        ->orderBy('rooms.id', 'asc')
        ->paginate(10);
        return $rooms;
    }

    public function getRoomsNotOccupied(Request $request){
        $rooms = RoomModel::where('ispublished',1)
        ->where('status','!=', 'Occupied')
        ->where('roomNo', 'LIKE', "%{$request->search}%")
        ->paginate(10);
        return $rooms;
    }
   
    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $room = RoomModel::findOrFail($request->id);
            $room->ispublished = $request->ispublished;
            $room->save();
            return $room;
        }

        $room = RoomModel::create($request->all());
        return $room;
    }

    public function destroy($id)
    {   
        $checkdata1 = CheckinModel::where('room_id', $id)->first();
        $checkdata2 = CheckOutModel::where('room_id', $id)->first();

        if(!$checkdata1 and !$checkdata2){
            RoomModel::destroy($id);
            return ['status' => 1];
        }
        else{
            return ['status' => 0];
        }
    }

    public function addInventory(Request $request){
       
        for($i = 0; $i < $request->quantity; $i++){
            $inventoryItem = RoomInventoryModel::create($request->all());
        }
        return $inventoryItem;
    }

    public function getInventorytatus(Request $request){
        $inventoryStatus = DB::select('select A.id, status, B.description from roominventory A INNER JOIN inventory_category B on A.inventory_id = B.id where A.inventory_id = '. $request->inventory_id .' and room_id = '. $request->room_id .'');
        // echo $inventoryStatus; exit;
        return $inventoryStatus;
    }

    public function updateInventoryStatus(Request $request){
        $inventoryStatus = RoomInventoryModel::findOrFail($request->inventory_id);
        $inventoryStatus->status = $request->status;
        $inventoryStatus->save();
        return $inventoryStatus;
    }
}
