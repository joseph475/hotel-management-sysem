<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;

class Web_ReservationController extends Controller
{
    public function index(){
        $variables = $this->getSystemVariables();
        $roomTypes = RoomTypeModel::latest()->limit(3)->get();
        // print_r($roomTypes); exit;
        $data = [
            'variables' => $variables,
            'roomTypes' => $roomTypes
        ];
        return view('pages.web.index', $data);
    }
}
