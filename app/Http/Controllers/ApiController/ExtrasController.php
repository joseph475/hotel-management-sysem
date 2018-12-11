<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExtrasModel;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extras = ExtrasModel::where('status',1)
        ->orderBy('createdDate', 'desc')
        ->paginate(10);
        return $extras;
    }

    public function store(Request $request)
    {
        $extras = ExtrasModel::create($request->all());
        return $extras;
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
