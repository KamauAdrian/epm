<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamTrainerLeader extends Model
{
    use HasFactory;
    public function team(){
        return $this->belongsTo('App\Models|TeamTrainer','team_leader_id');
    }
}
