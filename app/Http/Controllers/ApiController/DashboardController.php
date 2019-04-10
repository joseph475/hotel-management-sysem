<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;

class DashboardController extends Controller
{
    public function index(){
        $roomCards = DashboardModel::where('ispublished', 1)->orderBy('room_id')->get();
        return $roomCards;
    }
}
