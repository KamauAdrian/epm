<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTrainer extends Model
{
    use HasFactory;
    public function trainers(){
        return $this->belongsToMany('App\Models\User','team_trainer_member','team_id','trainer_id');
    }

    public function teamLeaders(){
        return $this->hasMany('App\Models\TeamTrainerLeader','team_id',);
    }
}
