<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;
    protected $fillable = [
        'pmo_employee_number',
        'pmo_department',
        'pmo_title',
        'pmo_overall_comment',
        'pmo_sign_date',
        'pmo_signature',
        'pmo_status',
    ];

    public function selfScores(){
        return $this->hasMany('App\Models\AppraisalReportPmo','appraisal_id');
    }
    public function supervisorScores(){
        return $this->hasMany('App\Models\AppraisalReportSupervisor','appraisal_id');
    }

//    public function supervisors(){
//        return $this->belongsToMany('App\Models\AppraisalReportSupervisor','appraisal_supervisor','appraisal_id','supervisor_id');
//    }
}
