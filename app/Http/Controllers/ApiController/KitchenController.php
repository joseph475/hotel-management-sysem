<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KitchenModel;

class KitchenController extends Controller
{
    
    public function index()
    {
        $foods = KitchenModel::where('status',1)
        ->orderBy('createdDate', 'desc')
        ->paginate(10);
        
        return $foods;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $food = KitchenModel::create($request->all());
        return $food;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
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
