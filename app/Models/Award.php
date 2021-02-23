<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    public function winners(){
        return $this->belongsToMany('App\Models\User','award_user','award_id','winner_id');
    }
}
