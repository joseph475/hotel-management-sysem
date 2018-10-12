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

    // public function __construct(){
        
    // }
    public function getSystemVariables(){
        $floor = SystemVariables::findOrFail('floor');

        $data = array(
            'floor' => $floor->value,
        );
        return $data;
    }
}
