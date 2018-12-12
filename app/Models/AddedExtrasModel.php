<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddedExtrasModel extends Model
{
    protected $table = 'addedextras';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'checkinId',
        'extrasId',
        'quantiry'
    ];
}
