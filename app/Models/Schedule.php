<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $table = 'schedule';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(Users::class,'id_users','id')
            ->where('role_id','=',1);
    }
    public function audit()
    {
        return $this->belongsTo(Users::class,'id_audit','id')
            ->where('role_id','=',2);
    }

    public function pic()
    {
        return $this->belongsTo(Users::class,'id_users','id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_users', 'id');
    }

    public function hasilAssessment()
    {
        return $this->hasMany(HasilAss::class, 'id_schedule', 'id');
    }
}
