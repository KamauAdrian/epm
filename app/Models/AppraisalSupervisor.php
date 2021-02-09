<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalSupervisor extends Model
{
    use HasFactory;

    protected  $fillable = [
        'supervisor_overall_comment',
        'supervisor_sign_date',
        'supervisor_signature',
        'improvement_areas',
        'supervisor_status',
    ];
}
