<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerDailyAttendanceReport extends Model
{
    use HasFactory;

    public function roles(){
        return $this->hasMany('App\Models\TrainerTrainingTaskRole','daily_attendance_report_id');
    }

    public function owner(){
        return $this->belongsTo('App\Models\User','trainer_id');
    }
}
