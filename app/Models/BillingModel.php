<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingModel extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'ORNumber';
    public $timestamps = false;
    protected $fillable = [
        'checkInId',
        'others',
        'room',
        'collection',
        'date_collected',
    ];
}
