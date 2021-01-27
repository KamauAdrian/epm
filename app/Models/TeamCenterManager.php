<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCenterManager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_leader_id',
        'team_leader_name',
        'description',
        'creator_id',
    ];

    public function centerManagers(){
        return $this->belongsToMany('App\Models\User','team_cm_member','team_id','center_manager_id');
    }
    public function teamLeaders(){
        return $this->hasMany('App\Models\TeamCmsLeader','team_id');
    }
}
