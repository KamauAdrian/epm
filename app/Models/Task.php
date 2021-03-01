<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "due_date",
        "description",
        "status",
        "completion_date"
    ];

    public function assignees(){
        return $this->belongsToMany('App\Models\User','assignee_task','task_id','assignee_id');
    }

    public function board(){
        return $this->belongsTo('App\Models\Board','board_id');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project','project_id');
    }

    public function subtasks(){
        return $this->hasMany('App\Models\SubTask','task_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\TaskComment','task_id');
    }
    public function attachments(){
        return $this->hasMany('App\Models\TaskAttachment','task_id');
    }
    public function links(){
        return $this->hasMany('App\Models\TaskLink','task_id');
    }
}
