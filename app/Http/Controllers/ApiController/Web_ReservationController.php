<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReservationModel;

class Web_ReservationController extends Controller
{

    public function store(Request $request)
    {   
        $reservation = array(
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'personal_id' =>  $request->personal_id,
            'personal_id_type' => $request->personal_id_type,
            'roomtype' => $request->roomtype,
            'compName' => $request->compName,
            'compAddress' => $request->compAddress,
            'checkInDate' =>  date('Y-m-d' , strtotime($request->checkInDate)),
            // 'checkOutDate' => date('Y-m-d' , strtotime($request->checkOutDate)),
            'adultsCount' => $request->adultsCount,
            'childrensCount' => $request->childrensCount
        );

        $reservation = ReservationModel::create($reservation);

        return $reservation;
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
