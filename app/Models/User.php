<?php

namespace App\Models;

use App\Jobs\NewUserActivateAccountJob;
use App\Jobs\ProjectCreatedJob;
use App\Mail\CreatePassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function user_profile(){
        return $this->hasOne("App\Models\UserProfile","user_id");
    }

    public function reports(){
        return $this->hasMany('App\Models\Report');
    }

    public function center(){
        return $this->belongsTo('App\Models\Center');
    }

    public function trainingSessions(){
        return $this->belongsToMany('App\Models\TrainingSession','trainer_training_session','trainer_id','training_session_id');
    }

    public function teamTrainers(){
        return $this->belongsToMany('App\Models\TeamTrainer');
    }

    public function teamCenterManagers(){
        return $this->belongsToMany('App\Models\TeamCenterManager');
    }
    public function projects(){
        return $this->belongsToMany('\App\Models\Project','project_collaborator','collaborator_id','project_id');
    }
    public function tasks(){
        return $this->belongsToMany('App\Model\Task','assignee_task','assignee_id','task_id');
    }

    public function awards(){
        return $this->belongsToMany('App\Models\Award','award_user','winner_id','award_id');
    }

    public function cmReports(){
        return $this->belongsToMany('App\Models\CmsReport','cms_report_reports','cm_id','report_id');
    }

    public static function updateUser($id,$data){
    DB::table('users')->where('id',$id)->update($data);
    }

    public static function SendNewUserAccountActivationEmail($email,$data){
        //dispatch email job
        $params=[];
        $params['email']=$email;
        $params['data']=$data;
        dispatch(new NewUserActivateAccountJob($params));
    }
}
