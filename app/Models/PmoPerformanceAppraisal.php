<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmoPerformanceAppraisal extends Model
{
    use HasFactory;

    public function selfScores(){
        return $this->hasMany('App\Models\PmoAppraisalSelfScore','appraisal_id');
    }
    public function supervisorScores(){
        return $this->hasMany('App\Models\PmoAppraisalSupervisorScore','appraisal_id');
    }
}
