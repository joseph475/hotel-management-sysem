<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'roomNo',
        'roomType',
        'floor',
        'status',
    ];
}
