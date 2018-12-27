<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SystemVariables;

class HotelInfoController extends Controller
{
    public function index()
    {
        $hotelInfo = SystemVariables::all();
        return $hotelInfo;
    }

    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $info = SystemVariables::where('key_name', $request->key_name)->first();
            $info->value = $request->value;
            $info->save();
            return $info;
        }
    }

    public function show($id)
    {
        //
    }

}
