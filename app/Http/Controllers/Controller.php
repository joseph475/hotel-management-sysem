<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SystemVariables;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSystemVariables(){
        $hotel = SystemVariables::where('key_name','hotel')->first();
        $floor = SystemVariables::where('key_name','floor')->first();
        $address = SystemVariables::where('key_name','address')->first();
        $email = SystemVariables::where('key_name','email')->first();
        $contact1 = SystemVariables::where('key_name','contact1')->first();
        $contact2 = SystemVariables::where('key_name','contact2')->first();

        $data = array(
            'hotel' => $hotel->value,
            'floor' => $floor->value,
            'address' => $address->value,
            'email' => $email->value,
            'contact1' => $contact1->value,
            'contact2' => $contact2->value,
        );  
        
        return $data;
    }
}
