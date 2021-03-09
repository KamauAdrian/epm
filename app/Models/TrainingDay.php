<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDay extends Model
{
    use HasFactory;

    public function sessions(){
        return $this->hasMany('App\Models\Session','day_id');
    }
    public function training(){
        return $this->belongsTo('App\Models\Training','training_id');
    }

    public function trainees(){
        return $this->belongsToMany('App\Models\Trainee','trainee_session_single_day','day_id','trainee_id');
    }

    //each training session belongs to many trainers
    public function trainers(){
        return $this->belongsToMany('App\Models\User','trainer_session_single_day','day_id','trainer_id');
    }

    public function classes(){
        return $this->belongsToMany('App\Models\SessionClass','training_session_classes_single_day','day_id','class_id');
    }
}
