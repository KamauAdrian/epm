<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterManager extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function center(){
        return $this->belongsTo('App\Models\Center');
    }
}
