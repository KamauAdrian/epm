<?php

namespace App\Http\Controllers;

use App\Jobs\ProjectCreatedJob;
use App\Mail\CreatePassword;
use App\Mail\ProjectCollaborationInvite;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $admin = User::find($id);
//        $projects = $admin->projects; gets all project collaborations
        if ($admin){
            $projects = Project::orderBy('created_at','desc')->get();
            return view('Epm.Projects.index',compact('projects'));
        }
        else{
            //response user not exist
        }

    }

    public function index_my_projects($id)
    {
        $admin = User::find($id);
        if ($admin){
            $projects = Project::orderBy('created_at','desc')->where('creator_id',$admin->id)->get();
            return view('Epm.Projects.index',compact('projects'));
        }
        else{
            //response user not exist
        }

    }

    public function index_project_collaborations($id)
    {
        $admin = User::find($id);
        if ($admin){
            $projects = $admin->projects; //gets all project collaborations
            return view('Epm.Projects.index',compact('projects'));
        }
        else{
            //response user not exist
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('Epm.Projects.create');
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
            'collaborators'=>'required',
        ]);
        $collaborators_ids = $request->input('collaborators');
        $project = $request->all();
        $new_project = new Project();
        $new_project->name = $project['name'];
        $new_project->creator_id = $id;
        $new_project->due_date = $project['due_date'];
        $new_project->description = $project['description'];
        $project_saved = $new_project->save();
        if ($project_saved){

            $saved_project = Project::find($new_project->id);
            $saved_project->collaborators()->attach($collaborators_ids);
            $collaborator = null;
            $initials=null;
            $split_name = explode(' ',$saved_project->owner->name);
            if (count($split_name)>1){
                $initials = substr($split_name[0],0,1).substr(end($split_name),0,1);
            }else{
                $initials = substr($saved_project->owner->name,0,1);
            }
            foreach ($collaborators_ids as $collaborator_id){
                //get collaborator email and send notification

                $user = User::find($collaborator_id);
                $email = $user->email;
                $collaborator = [
                    'name'=>$user->name,
                    'project_name'=>$saved_project->name,
                    'creator_name'=>$saved_project->owner->name,
                    'creator_initials'=>$initials,
                ];
                //send mail to user as project collaborator

               //dispatch email job
                $params=[];
                $params['email']=$email;
                $params['collaborator']=$collaborator;
                dispatch(new ProjectCreatedJob($params));

            }
//            dd('Project Saved',$saved_project);
        }
        return redirect('/adm/'.$id.'/list/projects')->with('success','Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$project_id)
    {
        $admin = User::find($id);
        $project = Project::find($project_id);
        $boards = $project->boards;
        return view('Epm.Projects.read',compact('project','boards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$project_id)
    {
        $project = Project::find($project_id);

        return view('Epm.Projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$project_id)
    {
        $admin = User::find($id);
        $existing_project = Project::find($project_id);
        $project = $request->all();
        $data = [
          'name'=>$project['name'],
          'due_date'=>$project['due_date'],
          'description'=>$project['description'],
        ];
        $collaborators = $project['collaborators'];
        $updated_project = $existing_project->update($data);
        if ($updated_project){
            $existing_project->collaborators()->attach($collaborators);
        }
     return redirect('/adm/'.$id.'/view/project/'.$project_id)->with('success','Project Updated Successfully');
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

    public function collaborators($id){
        $collaborators = Project::find($id)->collaborators;
        return response()->json($collaborators);
    }

    public function invite_collaborators($project_id){
        $existing_collaborators = json_decode(DB::table('project_collaborator')->where('project_id',$project_id)->pluck('collaborator_id'));
//        dd($existing_collaborators);
        $role = DB::table('roles')->where('name', 'Project Manager')->first();
        $collaborators_ids = null;
        if ($role){
            $collaborators_ids = json_decode(DB::table('users')->where('role_id',$role->id)->pluck('id'));
        }
        $new_collaborators = [];
        foreach ($collaborators_ids as $collaborators_id){
            if (!in_array($collaborators_id,$existing_collaborators)){
                $collaborators = DB::table('users')->orderBy('name')->where('role_id',$role->id)->where('id',$collaborators_id)->get();
                foreach ($collaborators as $collaborator){
                    $new_collaborators[] = $collaborator;
                }
            }
        }
//        return response()->json($trainers_new_member_ids);
        return response()->json($new_collaborators);
    }
}
