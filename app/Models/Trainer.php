<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function center(){

    }
//TODO: create a pivot table(trainee_trainer) trainer belongs to many trainees
    public function trainees(){
        return $this->belongsToMany('App\Models\Trainee');
    }
//TODO: create a pivot table(trainer_training_session)
//each trainer belongs to many training sessions
    public function trainingSessions(){
    return $this->belongsToMany('App\Models\TrainingSession');
    }
}
