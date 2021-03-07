<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    use HasFactory;
    protected $fillable = [
        "category",
        "name",
        "description",
    ];

    public function trainings(){
        return $this->belongsToMany('App\Models\Training','cohort_training','cohort_id','training_id');
    }
}
