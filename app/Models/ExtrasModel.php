<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtrasModel extends Model
{
    public function index()
    {   
        return view('pages.Extras.index'); 
    }
}
