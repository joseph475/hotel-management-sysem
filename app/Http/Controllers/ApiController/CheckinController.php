<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GuestModel;
use App\Models\RoomModel;
use App\Models\CheckinModel;

class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $guest = GuestModel::create($request->all());
        $guest_id = GuestModel::select('id')->whereRaw('id = (select max(`id`) from guests)')->first();
        
        $checkout = $request->checkOutDate;
        $checkout = date('Y-m-d H:i:s' , strtotime($checkout));

        $checkin = array(
            'room_id' => $request->room_id,
            'guestId' => $guest_id->id,
            'checkOutDate' => $checkout,
            'adultsCount' => $request->adultsCount,
            'childrenCount' => $request->childrenCount
        );
        // print_r($checkin);

        $checkin = CheckinModel::create($checkin);

        // print_r($request->room_id, );
        return [];
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
