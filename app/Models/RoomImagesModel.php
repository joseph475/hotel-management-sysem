<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImagesModel extends Model
{
    protected $table = 'room_images';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'roomtype_id',
        'filename'
    ];
}
