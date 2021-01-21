<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

public function templates(){
    return $this->belongsToMany('App\Models\ReportTemplate','report_target_group','target_group_id','report_template_id');
}
}
