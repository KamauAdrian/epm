<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmoPerformanceAppraisalReport extends Model
{
    use HasFactory;

    public function supervisors(){
        return $this->hasMany('App\Models\PmoSupervisor','appraisal_form_id');
    }
}
