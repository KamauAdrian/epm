<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $projects = Project::where('creator_id',$id)->get();
        return view('Epm.Projects.index',compact('projects'));
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
        $collaborators = $request->input('collaborators');
        $project = $request->all();
        $new_project = new Project();
        $new_project->name = $project['name'];
        $new_project->creator_id = $id;
        $new_project->due_date = $project['due_date'];
        $new_project->description = $project['description'];
        $project_saved = $new_project->save();
        if ($project_saved){
            Project::find($new_project->id)->collaborators()->attach($collaborators);
        }
        return redirect('/adm/'.$id.'/list/projects');
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
        return view('Epm.Projects.read',compact('project'));
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
