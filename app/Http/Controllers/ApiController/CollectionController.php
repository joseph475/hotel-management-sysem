<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillingModel;
use App\Models\BillingModelForTotal;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        // echo"test"; exit;
        
        $collections = BillingModel::select('*')
        ->whereBetween('date_collected', [ $request->dateFrom, $request->dateTo])
        ->orderBy('date_collected')
        ->paginate(10);

        $total_collections = BillingModel::select(DB::raw('SUM(collection) as total'))
        ->whereBetween('date_collected', [ $request->dateFrom, $request->dateTo])->get();

        $data = array(
            'total_collections' => $total_collections,
            'collections' => $collections,
        );

        return $data;
    }
}
