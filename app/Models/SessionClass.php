<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionClass extends Model
{
    use HasFactory;

    public function sessions(){
        return $this->belongsToMany('App\Models\TrainingSession','training_session_classes','class_id','session_id');
    }
}
