<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomInventoryCategoryModel;
use App\Models\RoomInventoryModel;

class InventoryListController extends Controller
{
    public function index(Request $request)
    {
        $inventoryList = RoomInventoryCategoryModel::orderBy('createdDate', 'asc')
        ->where('description', 'LIKE', "%{$request->search}%")
        ->paginate(10);
        return $inventoryList;
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
