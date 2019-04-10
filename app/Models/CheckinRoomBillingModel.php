<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckinRoomBillingModel extends Model
{
    protected $table = 'checkin_table_room_billing';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'checkin_id',
        'raterefno'
    ];
}
