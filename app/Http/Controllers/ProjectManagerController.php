<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('Epm.PMs.pm-dashboard',compact('user'));
    }

    public function pms()
    {
        $admin_user = Auth::user();
        $role = DB::table('roles')->where('name','Project Manager')->first();
        $project_managers = '';
        if ($role){
            $project_managers = User::orderBy('id','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-pms',compact('project_managers','admin_user'));
    }

    public function centers(){
        $admin_user = Auth::user();
        $centers = DB::table('centers')->get();
        return view('Epm.PMs.pm-list-centers',compact('centers','admin_user'));
    }

    public function cms_list()
    {
        $admin_user = Auth::user();
        $center_managers = '';
        $role = DB::table('roles')->where('name','Center Manager')->first();
        if ($role){
            $center_managers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-cms',compact('center_managers','admin_user'));
    }

    public function cm_add()
    {
        $centers = DB::table('centers')->get();
        return view('Epm.PMs.pm-add-cm',compact('centers'));
    }

    public function trainers_list()
    {
        $admin_user = Auth::user();
        $trainers='';
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = User::orderBy('created_at','desc')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-trainers',compact('trainers','admin_user'));
    }

    public function trainer_add()
    {
        return view('Epm.PMs.pm-add-trainer');
    }

    public function mentors_list()
    {
        $admin_user = Auth::user();
        $mentors = '';
        $role = DB::table('roles')->where('name','Mentor')->first();
        if ($role){
            $mentors = DB::table('mentors')->where('role_id',$role->id)->get();
        }
        return view('Epm.PMs.pm-list-mentors',compact('mentors','admin_user'));
    }

    public function mentor_add()
    {
        return view('Epm.PMs.pm-add-mentor');
    }

    public function sessions_list()
    {
        $admin_user = Auth::user();
        $sessions = DB::table('training_sessions')->get();
        return view('Epm.PMs.pm-list-sessions',compact('sessions','admin_user'));
    }

    public function session_add()
    {
        $role = DB::table('roles')->where('name','Trainer')->first();
        $trainers = DB::table('users')->where('role_id',$role->id)->get();
        return view('Epm.PMs.pm-add-session',compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
