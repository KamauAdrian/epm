<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function questions(){
        return $this->hasMany("App\Models\CmsReportQuestion",'report_id');
    }
//    public function c(){
//        return $this->belongsToMany('App\Models\User','cms_report_reports','report_id','cm_id');
//    }
}
