<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutModel extends Model
{
    protected $table = 'checkout';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'room_id',
        'guestId',
        'checkOutDate',
        'checkIn',
        'adultsCount',
        'childrenCount',
        'noOfDays',
        'penaltyHours'
    ];
}
