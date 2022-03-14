<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestModel extends Model
{
    protected $table = 'guests';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'contact',
        'companyName',
        'companyAddress',
        'email',
    ];
}
