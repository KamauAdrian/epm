<?php

namespace App\Http\Controllers;

use App\Mail\TaskLinkAdded;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\TaskLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TaskLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$id,$task_id)
    {
        $task = Task::find($task_id);
        if ($task){
            $new_task_link = new TaskLink();
            $new_task_link->name = $request['link'];
            $new_task_link->task_id = $request['task_id'];
            $response = null;
            if ($new_task_link->save()){
                $collaborators = $task->project->collaborators;
                foreach ($collaborators as $collaborator){
                    $new_link = [
                        'name'=>$collaborator->name
                    ];
                    Mail::to($collaborator->email)->send(new TaskLinkAdded($new_link));
                }
                $response = 'Task Link Saved Successfully';
            }
            return $response;
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
    public function destroy($id,$link_id)
    {
        $response = '';
        if (TaskLink::find($link_id)){
            $link = TaskLink::find($link_id);
            $task = $link->task;
            $deleted = DB::table('task_links')->where('id',$link->id)->where('task_id',$task->id)->delete();
            if ($deleted){
                $response = 'Link Deleted Successfully';
            }

        }

        return $response;
    }
}
