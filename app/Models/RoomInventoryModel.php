<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomInventoryModel extends Model
{
    protected $table = 'roominventory';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'room_id',
        'inventory_id',
        'status'
    ];
}
