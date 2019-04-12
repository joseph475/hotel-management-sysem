<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'personal_id',
        'personal_id_type',
        'roomtype',
        'name',
        'mobile',
        'email',
        'compName',
        'compAddress',
        'checkInDate',
        'checkOutDate',
        'adultsCount',
        'childrensCount',
        'adultsCount',
        'status',
        'room_id',
    ];   
}
