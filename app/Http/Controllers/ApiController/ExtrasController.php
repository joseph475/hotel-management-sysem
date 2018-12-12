<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExtrasModel;
use App\Models\AddedExtrasModel;

class ExtrasController extends Controller
{
   
    public function index()
    {
        $extras = ExtrasModel::orderBy('createdDate', 'desc')
        ->paginate(10);
        return $extras;
    }

    public function store(Request $request)
    {   
        if ($request->isMethod('put')) {
            $extras = ExtrasModel::findOrFail($request->id);
            $extras->ispublished = $request->ispublished;
            $extras->save();
            return $extras;
        }

        $extras = ExtrasModel::create($request->all());
        return $extras;
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $checkdata1 = AddedExtrasModel::where('extrasId', $id)->first();

        if(!$checkdata1){
            ExtrasModel::destroy($id);
            return ['status' => 1];
        }
        else{
            return ['status' => 0];
        }
    }
}
