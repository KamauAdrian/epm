<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reason',
    ];

    public function types(){
        return $this->hasMany("App\Models\EmployeeLeaveType","leave_id");
    }
    public function owner(){
        return $this->belongsTo("App\Models\User","applicant_id");
    }
}
