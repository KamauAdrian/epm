<?php

namespace App\Http\Controllers;

use App\Models\TeamTrainer;
use App\Models\TeamTrainerLeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admin = User::find($id);
        if ($admin){
         if ($admin->role->name=="Su Admin" || $admin->role->name=="Project Manager"){
             $teams = TeamTrainer::orderBy('created_at','desc')->get();
             return view('Epm.Teams.Trainers.index',compact('teams'));
         }
        if ($admin->role->name=="Trainer"){
//            $teams = $admin->teamTrainers;
//            return view('Epm.Teams.Trainers.index',compact('teams'));
        }
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = '';
        $role = DB::table('roles')->where('name','Trainer')->first();
        if ($role){
            $trainers = DB::table('users')->where('role_id',$role->id)->get();
        }
        return view('Epm.Teams.Trainers.create',compact('trainers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $admin = User::find($id);
        if ($admin){
            $trainers_team = new TeamTrainer();
            $trainers_team->name = $request->name;
            $trainers_team->description = $request->about;;
            $team_leaders = $request->input('team_leader_ids');
            $trainers_team->creator_id = $admin->id;
            $new_team_created = $trainers_team->save();
            if ($new_team_created && $team_leaders!=null){
                $saved_team = TeamTrainer::find($trainers_team->id);
                $team_leader_ids = [];
                foreach ($team_leaders as $team_leader){
                    $team_leader_ids[] = [
                        'team_leader_id'=>$team_leader,
                        'team_id'=>$saved_team->id,
                    ];
                }
                $saved_team->trainers()->attach($team_leaders);
                TeamTrainerLeader::insert($team_leader_ids);
            }
            return redirect('/adm/'.$admin->id.'/list/team/trainers');
        }
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
    public function edit($id,$team_id)
    {
        $team = DB::table('team_trainers')->where('id',$team_id)->first();
        return view('Epm.Teams.Trainers.edit',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$team_id)
    {
        $admin = User::find($id);
        $trainer_team_member_s_id = $request->trainer_team_member_s_id;
        $trainer_team = TeamTrainer::find($team_id);
        $trainer_team->trainers()->attach($trainer_team_member_s_id);
        return redirect("/adm/".$admin->id."/list/team/trainers")->with("success","Trainers Successfully added to team");
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
