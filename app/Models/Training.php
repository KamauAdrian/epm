<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'training',
        'start_date',
        'end_date',
        'type',
        'center',
        'institution',
        'description',
        'status',
    ];

//    public function trainees(){
//        return $this->belongsToMany('App\Models\Trainee','trainee_training_session','training_session_id','trainee_id');
//    }
//
//    //each training session belongs to many trainers
//    public function trainers(){
//        return $this->belongsToMany('App\Models\User','trainer_training_session','training_session_id','trainer_id');
//    }
//
//    public function classes(){
//        return $this->belongsToMany('App\Models\SessionClass','training_session_classes','session_id','class_id');
//    }
    public function trainingDays(){
        return $this->hasMany('App\Models\TrainingDay','training_id','id');
    }
}
