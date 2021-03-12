<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    public function trainingDays(){
        return $this->hasMany('App\Models\TrainingDay','category_id','id');
    }
}
