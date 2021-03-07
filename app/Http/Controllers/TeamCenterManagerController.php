<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\TeamCenterManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamCenterManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = TeamCenterManager::orderBy("created_at","desc")->get();
        return view('Epm.Teams.Cms.index',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::where("name","Center Manager")->first();
        if ($role){
            $cms = User::where("role_id",$role->id)->get();
            return view('Epm.Teams.Cms.create',compact('cms'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $messages = [
            'team_leaders.required'=>"Please Select At Least One Team Leader"
        ];
        $this->validate($request,[
            'name'=>'required',
            'team_leaders'=>'required',
            'about'=>'required',
        ],$messages);
        $admin = User::find($id);
        $cms_team = new TeamCenterManager();
        $cms_team->name = $request->name;
        $cms_team->description = $request->about;
        $team_leaders = $request->input('team_leaders');
        $cms_team->creator_id = $admin->id;
        $new_team_created = $cms_team->save();

        if ($new_team_created){
            if ($team_leaders){
            $cms_team->teamLeaders()->attach($team_leaders);
            }
        }
        return redirect('/adm/'.$id.'/list/team/cms')->with("success","New Team Created successfully");
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
