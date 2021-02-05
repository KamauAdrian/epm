<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmoSupervisor extends Model
{
    use HasFactory;

    public function appraisals(){
        return $this->hasMany('App\Models\PmoPerformanceAppraisals');
    }
}
