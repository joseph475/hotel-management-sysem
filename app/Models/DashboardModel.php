<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardModel extends Model
{
    protected $table = 'vw_dashboard_room_list';
    protected $primaryKey = 'room_id';
    public $timestamps = false;
}
