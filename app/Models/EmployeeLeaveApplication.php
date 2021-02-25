<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reason',
    ];

    public function types(){
        return $this->hasMany('');
    }
}
