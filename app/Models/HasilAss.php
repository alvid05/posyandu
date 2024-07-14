<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAss extends Model
{
    protected $table = 'hasil_assesment';
    protected $guarded = [];

    public function assesment()
    {
        return $this->belongsTo(Assesment::class,'id','hasil_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule', 'id');
    }

    public function audit()
    {
        return $this->belongsTo(Users::class,'audit_id','id');
    }
}
