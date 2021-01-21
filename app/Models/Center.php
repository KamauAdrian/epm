<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'county',
            'town',
    ];

    public function centerManagers(){
        return $this->hasMany('App\Models\User');
    }
}
