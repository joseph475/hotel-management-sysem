<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DashboardModel;

class UpcomingCheckoutController extends Controller
{
    public function index(Request $request){
        $upcomingCheckouts = DashboardModel::whereNotNull('checkin_id')
        ->where(function($q) use ($request){
            $q->where('name', 'LIKE', "%{$request->search}%")
              ->orWhere('roomNo', 'LIKE', "%{$request->search}%");
        })
        ->orderBy('checkOutDate', 'asc')
        ->paginate(10);
        return $upcomingCheckouts;
    }
    
}
