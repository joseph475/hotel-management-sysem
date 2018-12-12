<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomModel;

class RoomsController extends Controller
{
    /**  
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = RoomModel::join('roomtypes', 'rooms.roomType', '=', 'roomtypes.id')
        ->select('rooms.id', 'rooms.roomNo', 'roomtypes.type', 'rooms.floor', 'roomtypes.rate', 'roomtypes.rateperhour','rooms.status','rooms.ispublished')
        ->orderBy('rooms.createdDate', 'desc')
        ->paginate(10);
        return $rooms;
    }

    public function getRoomsNotOccupied(){
        $rooms = RoomModel::where('ispublished',1)
        ->where('status','!=', 'Occupied')
        ->paginate(10);
        return $rooms;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        RoomModel::destroy($id);
        return $id;
    }
}
