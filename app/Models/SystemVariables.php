<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemVariables extends Model
{
    protected $table = 'system_variables';
    // protected $primaryKey = 'name';
    public $timestamps = false;
    protected $fillable = [
        'value'
    ];
}
