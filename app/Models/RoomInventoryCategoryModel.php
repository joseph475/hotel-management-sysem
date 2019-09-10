<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomInventoryCategoryModel extends Model
{
    protected $table = 'inventory_category';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'description'
    ];
}
