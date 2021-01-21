<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','category',
        'email','county',
        'phone_number','constituency',
        'center_id','gender',
        'id_number','interests',
        'field_of_study','level_of_education',
        'level_of_computer_literacy','age',
        'center_id',
    ];


//trainee belongs to one training center
    public function center(){
        return $this->belongsTo('App\Models\Center');
    }
//TODO:create pivot table (trainee_trainer) trainee belongs to many trainers

    public function trainers(){
        return $this->belongsToMany('App\Models\Trainer');
    }

//TODO:create pivot table (trainee_training_session) trainee belongs to many training sessions

    public function sessions(){
        return $this->belongsToMany('App\Models\TrainingSession','trainee_training_session','trainee_id','training_session_id');
    }
    public function mentorship(){

    }
}
