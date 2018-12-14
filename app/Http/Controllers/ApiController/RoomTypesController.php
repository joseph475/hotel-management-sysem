<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;


class RoomTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomtypes = RoomTypeModel::where('ispublished',1)
        ->orderBy('createdDate', 'desc')
        ->paginate(10);
        
        return $roomtypes;
    }

    public function upload(Request $request){
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images') . '/uploads', $imageName);
        
        $roomType = RoomTypeModel::findOrFail($request->id);
        $roomType->description = $request->description;
        $roomType->image = $imageName;
        $roomType->save();

        return back();
    }

    public function store(Request $request)
    {
        if ($request->isMethod('put')) {
            $roomType = RoomTypeModel::findOrFail($request->id);
            $roomType->description = $request->description;
            $roomType->image = $request->image;
            $roomType->save();
            return redirect('/RoomTypes');
        }

        $roomType = RoomTypeModel::create($request->all());
        return $roomType;
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
