<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomInventoryModel;
use App\Models\RoomInventoryCategoryModel;
use Illuminate\Support\Facades\DB;

class InventoryStatusReportController extends Controller
{
    public function printperRoom($id = ''){
        $variables = $this->getSystemVariables();

        if($id != ''){
            $inventoryStatus = DB::select('select room_id, B.description, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 1 and room_id = '. $id .') as good, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 2 and room_id = '. $id .') as damaged, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 3 and room_id = '. $id .') as missing 
            FROM roominventory A inner join inventory_category B on A.inventory_id = B.id where room_id = '. $id .' GROUP by room_id, inventory_id, B.description ORDER By room_id');
        }
        else{
            $inventoryStatus = DB::select('select room_id, B.description, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 1 and room_id = A.room_id) as good, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 2 and room_id = A.room_id) as damaged, 
            (select count(status) from roominventory where A.inventory_id = inventory_id and status = 3 and room_id = A.room_id) as missing 
            FROM roominventory A inner join inventory_category B on A.inventory_id = B.id GROUP by room_id, inventory_id, B.description ORDER By room_id');
        }

        $data = array(
            'variables' => $variables,
            'inventoryStatus' => $inventoryStatus,
        );

        $pdf = \PDF::loadView('pdf.InventoryReport', $data)->setOptions(['defaultFont' => 'sans-serif', 'fontHeightRatio' => '0.8']);
        return $pdf->stream('InventoryReport.pdf');

    }
}
