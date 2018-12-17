<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTypeModel extends Model
{
    protected $table = 'roomtypes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'type',
        'description',
        'rate',
        'rateperhour',
        'maxAdult',
        'maxChildren',
        'image'
    ];
}
