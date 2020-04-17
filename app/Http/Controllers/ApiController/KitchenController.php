<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KitchenModel;
use App\Models\AddedFoodsModel;

class KitchenController extends Controller
{
    
    public function index(Request $request)
    {
        $foods = KitchenModel::orderBy('createdDate', 'desc')
        ->where('menuName', 'LIKE', "%{$request->search}%")
        ->paginate(10);
        
        return $foods;
    }
    public function getIsPublishedFoods(){
        $foods = KitchenModel::where('ispublished' , 1)->orderBy('createdDate', 'desc')->get();
        return $foods;
    }

    public function store(Request $request)
    {   
        if ($request->isMethod('put')) {
            $food = KitchenModel::findOrFail($request->id);
            $food->ispublished = $request->ispublished;
            $food->save();
            return $food;
        }
        $food = KitchenModel::create($request->all());
        return $food;
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $checkdata1 = AddedFoodsModel::where('foodsId', $id)->first();

        if(!$checkdata1){
            KitchenModel::destroy($id);
            return ['status' => 1];
        }
        else{
            return ['status' => 0];
        }
    }
}
