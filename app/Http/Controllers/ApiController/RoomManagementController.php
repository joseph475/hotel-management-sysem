<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;

class RoomManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoomsNotOccupied(Request $request){
        $rooms = RoomModel::where('ispublished',1)
        ->where('status','!=', 'Occupied')
        ->where(function($q) use ($request){
            $q->where('roomNo', 'LIKE', "%{$request->search}%")
              ->orWhere('status', 'LIKE', "%{$request->search}%");
        })
        ->paginate(10);
        return $rooms;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $result = RoomModel::findOrFail($id)->update(['status'=> $request->status]);
        return ($result)? ['status'=> 1, 'id'=> $id] : ['status'=> 0];
    }

    public function destroy($id)
    {
        //
    }
}
