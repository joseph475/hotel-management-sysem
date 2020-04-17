<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomInventoryCategoryModel;
use App\Models\RoomInventoryModel;

class InventoryListController extends Controller
{
    public function index()
    {
        $inventoryList = RoomInventoryCategoryModel::orderBy('createdDate', 'asc')
        ->paginate(10);
        return $inventoryList;
    }
    public function getIsPublishedExtras(){
        $extras = ExtrasModel::where('ispublished' , 1)->orderBy('createdDate', 'asc')->get();
        return $extras;
    }

    public function store(Request $request)
    {   
        if ($request->isMethod('put')) {
            $inventoryList = RoomInventoryCategoryModel::findOrFail($request->id);
            $inventoryList->ispublished = $request->ispublished;
            $inventoryList->save();
            return $inventoryList;
        }

        $inventoryList = RoomInventoryCategoryModel::create($request->all());
        return $inventoryList;
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $checkdata1 = RoomInventoryModel::where('inventory_id', $id)->first();

        if(!$checkdata1){
            RoomInventoryCategoryModel::destroy($id);
            return ['status' => 1];
        }
        else{
            return ['status' => 0];
        }
    }
}
