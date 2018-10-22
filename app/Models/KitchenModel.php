<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitchenModel extends Model
{
    protected $table = 'foods';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'menuName',
        'servings',
        'remaining',
        'cost',
        'sellingPrice',
        'status'
    ];
}
