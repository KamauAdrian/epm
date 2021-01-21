<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clock extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'user_id',
        'status',
    ];

    public function center(){

    }

    public function user(){

    }
}
