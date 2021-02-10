<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public function project(){
        return $this->belongsTo('App\Models\Project','project_id');
    }
    public function tasks(){
        return $this->hasMany('App\Models\Task','board_id');
    }
}
