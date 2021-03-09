<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function facilitators(){
        return $this->belongsToMany("App\Models\User","session_facilitator","session_id","facilitator_id");
    }
}
