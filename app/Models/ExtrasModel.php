<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtrasModel extends Model
{
    protected $table = 'extras';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'description',
        'cost',
        'status'
    ];
}
