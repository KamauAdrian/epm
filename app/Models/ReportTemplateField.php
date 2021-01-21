<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTemplateField extends Model
{
    use HasFactory;

    public function template(){
        return $this->belongsTo('App\Models\ReportTemplate');
    }
}
