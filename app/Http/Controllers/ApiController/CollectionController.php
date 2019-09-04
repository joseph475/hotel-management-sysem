<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillingModel;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        // echo"test"; exit;
        $collections = BillingModel::select('*')
        ->whereBetween('date_collected', [ $request->dateFrom, $request->dateTo])
        ->orderBy('date_collected')
        ->paginate(10);
        return $collections;
    }
}
