<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_name',
        'session_date',
        'session_start_time',
        'session_end_time',
        'session_venue_institution',
        'session_venue_town',
        'session_about',
        'status',
    ];

    //each training session belongs to many trainees
    public function trainees(){
        return $this->belongsToMany('App\Models\Trainee','trainee_training_session','training_session_id','trainee_id');
    }

    //each training session belongs to many trainers
    public function trainers(){
        return $this->belongsToMany('App\Models\User','trainer_training_session','training_session_id','trainer_id');
    }

    public function classes(){
        return $this->belongsToMany('App\Models\SessionClass','training_session_classes','session_id','class_id');
    }
    public function trainingDays(){
        return $this->hasMany('App\Models\TrainingDay','session_id','id');
    }

}
