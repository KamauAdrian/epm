<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    use HasFactory;

    public function groups(){
        return $this->belongsToMany('App\Models\Role','report_target_group','report_template_id','target_group_id');
    }

    public function questions(){
        return $this->hasMany('App\Models\ReportQuestion');
    }

    public function fields(){
        return $this->hasMany('App\Models\ReportTemplateField');
    }
}
