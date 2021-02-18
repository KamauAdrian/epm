<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'due_date',
        'description'
    ];

    public function owner(){
        return $this->belongsTo('\App\Models\User','creator_id','id');
    }

    public function collaborators(){
        return $this->belongsToMany('\App\Models\User','project_collaborator','project_id','collaborator_id');
    }

    public function boards(){
        return $this->hasMany('App\Models\Board','project_id');
    }

}
