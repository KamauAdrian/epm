<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamCenterManager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = DB::table('team_center_managers')->orderBy('created_at','desc')->get();
        $members = '';
        foreach ($teams as $team){
            $members = \App\Models\TeamCenterManager::find($team->id);
        }
        return view('Epm.Teams.cms',compact('teams','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cms = '';
        $role = DB::table('roles')->where('name','Center Manager')->first();
        if ($role){
            $cms = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.Teams.Cms.add',compact('cms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request,[
            'name'=>'required',
            'about'=>'required',
        ]);
        dd($request->all());
        $admin = User::find($id);
        $cms_team = new \App\Models\TeamCenterManager();
        $cms_team->name = $request->name;
        $cms_team->description = $request->about;
        $team_leaders = $request->input('team_leader_ids');
        $cms_team->creator_id = Auth::id();

        $new_team_created = $cms_team->save();

        if ($new_team_created && $team_leaders!=null){
            $saved_cms_team = TeamCenterManager::find($cms_team->id);
            $team_leaders_ids = [];
            foreach ($team_leaders as $team_leader){
                $team_leaders_ids[] = [
                    'team_leader_id'=>$team_leader,
                    'team_id'=>$saved_cms_team->id,
                ];
            }
            DB::table('team_cms_leaders')->insert($team_leaders_ids);
            $saved_cms_team->centerManagers()->attach($team_leaders);
        }
        return redirect('/adm/'.$id.'/list/team/cms');
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

    /**
     * Add center managers as members to team
     */
    public function add_members($id,$team_id){
        $team = DB::table('team_center_managers')->where('id',$team_id)->first();
        return view('Epm.Teams.Cms.members-add',compact('team'));
    }

    /**
     * save/store center managers as members to team
     */
    public function store_members(Request $request,$id,$team_id){
        $messages = [
            'cm_team_member_s_id.required'=>'Please select at least one member'
        ];
        $this->validate($request,[
            'cm_team_member_s_id'=>'required'
        ],$messages);
//        dd($request->all());
        $admin = User::find($id);
        $cm_team_member_s_id = $request->input('cm_team_member_s_id');
        $team_cm =  TeamCenterManager::find($team_id);
        $team_cm->centerManagers()->attach($cm_team_member_s_id);
        return redirect('/adm/'.$id.'/list/team/cms')->with('success','Center Managers Successfully added to team');
    }
}
