<?php

namespace App\Http\Controllers\WebController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestsController extends Controller
{
    public function index()
    {   
        return view('pages.admin.Guests.index'); 
    }
    public function ArchivedGuests(){
        return view('pages.admin.Guests.archivedGuest'); 
    }
}
