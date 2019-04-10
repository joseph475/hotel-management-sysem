<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinModel extends Model
{
    protected $table = 'checkin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'room_id',
        'guestId',
        'checkOutDate',
        'adultsCount',
        'childrenCount',
        'remaining_time'
    ];
}
