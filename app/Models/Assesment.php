<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Assesment extends Model
{
    protected $table = 'assesment';
    protected $guarded = [];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule', 'id');
    }

    public function allData()
    {
        return $this->join('schedule', 'assesment.id_schedule', '=', 'schedule.id')
            ->join('users', 'schedule.id_users', '=', 'users.id')
            ->select('assesment.*', 'schedule.*', 'users.*','assesment.id as id_ass')
            ->get();
    }

    public function idData($id)
    {
        return $this->join('schedule', 'assesment.id_schedule', '=', 'schedule.id')
            ->join('users', 'schedule.id_users', '=', 'users.id')
            ->where('users.id','=',$id)
            ->select('assesment.*', 'schedule.*', 'users.*','assesment.id as id_ass')
            ->get();
    }
}
