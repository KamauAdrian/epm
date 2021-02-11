<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function assignees(){
        return $this->belongsToMany('App\Models\User','assignee_task','task_id','assignee_id');
    }

    public function board(){
        return $this->belongsTo('App\Models\Board','board_id');
    }
}
