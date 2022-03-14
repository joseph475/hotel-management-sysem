<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BillingModel;
use App\Models\BillingModelForTotal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
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

    public function printReport($type, $dateFrom, $dateTo){
        $variables = $this->getSystemVariables();
        $collections = BillingModel::select('*')
        ->whereBetween('date_collected', [ $dateFrom, $dateTo ])
        ->orderBy('date_collected')
        ->get();

        $total_collections = BillingModel::select(DB::raw('SUM(collection) as total'))
        ->whereBetween('date_collected', [ $dateFrom, $dateTo ])->get();

        $data = array(
            'variables' => $variables,
            'type' => $type,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'total_collections' => $total_collections,
            'collections' => $collections,
        );

        $pdf = \PDF::loadView('pdf.collectionReport', $data)->setOptions(['defaultFont' => 'sans-serif', 'fontHeightRatio' => '0.8']);
        return $pdf->stream('collectionReport.pdf');
        // print_r($data); exit;
        // return $data;

    }
    public function searchOR($search){
        $collections = BillingModel::select('*')
        ->where('ORNumber', $search)->get();
        return $collections;
    }
    public function printReceipt($id){
        $variables = $this->getSystemVariables();
        $foods = DB::select('Select * from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = '. $id);
        $extras = DB::select('Select * from addedextras A inner join extras B on A.extrasId = B.id where A.checkinId = '. $id);
        $room = DB::select('Select *, A.created_at as checkin_date from checkin_table_room_billing A inner join roomtype_additional_rates B on A.rate_id = B.id where A.checkin_Id = '. $id);
        $info = DB::select('Select * from checkin A inner join billing B on A.id = B.checkInId inner join guests C on A.guestId = C.id
         inner join rooms D on A.room_id = D.id inner join roomtypes E on D.roomType = E.id where A.id = ' . $id);
      
        //     print_r($room);
        //  exit;

         $checkinDate =  date_create($room[0]->checkin_date);
         $diff = date_diff($checkinDate, Carbon::now());
 
         $hours = $diff->format("%h");
         $days = $diff->format("%d");
 
        //  print_r($info);
        //  exit;
         if ($days > 0) {
             $totalRoom =  DB::select('Select rate from roomtype_additional_rates A inner join checkin_table_room_billing B 
                 on A.id = B.rate_id 
                 where checkin_id = '. $id .' GROUP by checkin_id, A.rate');
             $totalRoom  = $totalRoom[0]->rate * $days;
         } else {
             $totalRoom =  DB::select('Select rate from roomtype_additional_rates A inner join checkin_table_room_billing B 
             on A.id = B.rate_id 
             where checkin_id = '. $id .' GROUP by checkin_id, A.rate');
             $totalRoom  = $totalRoom[0]->rate;
         }

        // $totalRoom =  DB::select('Select 
        //     Sum((CASE WHEN days > 0 then
        //             (select rate from roomtype_additional_rates where id = rate_id) * days
        //         ELSE
        //             (select rate from roomtype_additional_rates where id = rate_id)
        //     End)) as rate
        //     from checkin_table_room_billing where checkin_id = '. $id .' GROUP by checkin_id');

        $totalFoods = DB::select('select sum(price) as price 
            from ( select (select sellingPrice from foods where id = foodsId) * sum(quantity) as price
            from addedfoods where checkinId = '. $id .' GROUP By foodsId ) as t1');

        $totalExtras = DB::select('select sum(price) as price 
            from ( select (select cost from extras where id = extrasId) * sum(quantity) as price
            from addedextras where checkinId = '. $id .' GROUP By extrasId ) as t1');
        
        $grandTotal = $totalRoom + $totalFoods[0]->price + $totalExtras[0]->price;

        $data = array(
            'variables' => $variables,
            'foods' => $foods,
            'extras' => $extras,
            'rooms' => $room,
            'info' => $info,
            'totalRoom' => $totalRoom,
            'totalFoods' => $totalFoods,
            'totalExtras' => $totalExtras,
            'grandTotal' => $grandTotal,
            'days' => $days,
            'hours' => $hours,
        );
        // echo $grandTotal; exit;
        // echo "<pre>"; print_r($data); exit;
        $pdf = \PDF::loadView('pdf.receipt', $data)->setOptions(['defaultFont' => 'sans-serif', 'fontHeightRatio' => '0.8']);
        return $pdf->stream('receipt.pdf');
    }
}
