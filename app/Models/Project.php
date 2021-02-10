<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function collaborators(){
        return $this->belongsToMany('\App\Models\User','project_collaborator','project_id','collaborator_id');
    }

}
