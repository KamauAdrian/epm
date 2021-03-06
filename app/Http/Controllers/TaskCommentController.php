<?php

namespace App\Http\Controllers;

use App\Jobs\ProjectCreatedJob;
use App\Jobs\TaskCommentedAddedJob;
use App\Mail\TaskCommentAdded;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskCommentController extends Controller
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
        $comment = $request->all();
        $collaborator = User::find($id);
        $new_comment = new TaskComment();
        $new_comment->collaborator_id = $comment['id'];
        $new_comment->task_id = $task->id;
        $new_comment->comment = $comment['comment'];
       $new_comment_saved =  $new_comment->save();
       $response = null;
       if ($new_comment_saved){
           $name = User::find($new_comment->collaborator_id);
           $split_name = explode(' ',$name->name);
           $avtar_icon_name = null;
           if (count($split_name)>1){
               $avtar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
           }else{
               $avtar_icon_name = substr($name->name,0,1);
           }



           $collaborators = $task->project->collaborators;
           if ($collaborators){
               foreach($collaborators as $task_collaborator){
                   $comment_update = [
                       'name'=>$task_collaborator->name,
                       'task'=>$task->name,
                       'comment_creator'=>$collaborator->name,
                   ];

                   $params=[];
                   $params['email']=$task_collaborator->email;
                   $params['comment_update']=$comment_update;
                   dispatch(new TaskCommentedAddedJob($params));
//                   TaskCommentedAddedJob::dispatch($params);
               }
           }
           $response = [
               'name'=>$name->name,
               'avtar_name'=>$avtar_icon_name,
               'comment'=>$new_comment->comment,
               'date_time'=>Carbon::parse($new_comment->created_at)->diffForHumans(),
           ];
       }

        return $response;
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
