<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsReportQuestionOption extends Model
{
    use HasFactory;

    public function question(){
        return $this->belongsTo("App\Models\CmsReportQuestion","question_id");
    }
}
