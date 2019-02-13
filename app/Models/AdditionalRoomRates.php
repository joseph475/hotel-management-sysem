<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalRoomRates extends Model
{
    protected $table = 'roomtype_additional_rates';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'roomtype_id',
        'hours',
        'rate'
    ];
}
