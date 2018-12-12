<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddedFoodsModel extends Model
{
    protected $table = 'addedfoods';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'checkinId',
        'foodsId',
        'quantiry'
    ];
}
