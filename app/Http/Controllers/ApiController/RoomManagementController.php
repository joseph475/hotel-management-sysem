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
    public function index()
    {
        //
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
