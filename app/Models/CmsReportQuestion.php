<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsReportQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question'
    ];

    public function report(){
        return $this->belongsTo("App\Models\CmsReport","report_id");
    }

    public function options(){
        return $this->hasMany("App\Models\CmsReportQuestionOption","question_id");
    }
}
