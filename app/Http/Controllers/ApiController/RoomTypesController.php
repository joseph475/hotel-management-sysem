<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;


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
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        // $room_images = RoomImagesModel::
        return $roomtypes;
    }

    public function upload(Request $request){
        
        if(isset($request->image)){
            foreach ($request->image as $photo) {
                $filename = $photo->getClientOriginalName();
                $photo->move(public_path('images') . '/uploads', $filename);
                $image = (['roomtype_id' => $request->id, 'filename' => $filename]);
                $image = RoomImagesModel::create($image);
            }
        }
        $roomType = RoomTypeModel::findOrFail($request->id);
        $roomType->description = $request->description;
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
