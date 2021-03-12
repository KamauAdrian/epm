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
        'center_id',
        'cohort_id',
        'institution_id',
        'description',
        'status',
    ];

    public function trainees(){
        return $this->belongsToMany('App\Models\Trainee','trainee_training','training_id','trainee_id');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\JobCategory','training_category',"training_id","category_id");
    }

    //each training session belongs to many trainers
    public function trainers(){
        return $this->belongsToMany('App\Models\User','trainer_training','training_id','trainer_id');
    }

    public function trainingDays(){
        return $this->hasMany('App\Models\TrainingDay','training_id','id');
    }
}
