<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\RoomTypeModel;
use App\Models\RoomImagesModel;
use App\Models\AdditionalRoomRates;
use Illuminate\Support\Facades\DB;

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

    public function changePenaltyRate(Request $request){
        $penaltyRateChange = RoomTypeModel::findOrFail($request->id);
        $penaltyRateChange->rateperhour = $request->rateperhour;
        $penaltyRateChange->save();
        return $penaltyRateChange;
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
    public function addRoomRate(Request $request){
        $roomRate = AdditionalRoomRates::create($request->all());
        return $roomRate;
    }
    
    public function getRoomRate($id){
        $roomRate = AdditionalRoomRates::select('id', 'hours', 'rate')->where('roomtype_id', $id)->orderBy('hours')->get();
        // echo "<pre>"; print_r($roomRate); exit;
        return $roomRate;
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

        $roomType = array(
            'type' => $request->type,
            'description' => $request->description,
            'maxAdult' =>  $request->maxAdult,
            'maxChildren' => $request->maxChildren,
        );
        
        $roomType = RoomTypeModel::create($request->all());
        return $roomType;
    }

   
    public function destroy($id)
    {
        //
    }
}
