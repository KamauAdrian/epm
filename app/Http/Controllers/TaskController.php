<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
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
    public function store(Request $request,$id,$board_id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $admin = User::find($id);
        $board = Board::find($board_id);
        $task = $request->all();
        $new_task = new Task();
        $new_task->name = $task['name'];
        $new_task->due_date = $task['due_date'];
        $new_task->creator_id = $admin->id;
        $new_task->board_id = $board_id;
        $new_task_saved = $new_task->save();
        if ($new_task_saved && $request->assignees){
            $assignees = $task['assignees'];
            Task::find($new_task->id)->assignees()->attach($assignees);
            if ($assignees){
                foreach ($assignees as $assignee){
                    $user = User::find($assignee);
                    //send email notification on task assigment
                }
            }
        }
        return redirect('/adm/'.$id.'/view/project/'.$board->project_id)->with('success','Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$task_id)
    {
        $task = Task::find($task_id);
        $board = $task->board;
        $project = Project::find($board->project_id);
        $project_boards = $project->boards;
        $task_assignees = $task->assignees;
        $comments = $task->comments;
        $assignees = [];
        if($task_assignees){
            foreach ($task_assignees as $task_assignee){
                $split_name = explode(' ',$task_assignee->name);
                if (count($split_name)>1){
                    $assignees[] = substr($split_name[0],0,1).substr(end($split_name),0,1);
                }else{
                    $assignees[] = substr($task_assignee->name,0,1);
                }
            }
        }
        $response = [
            'task_name'=>$task->name,
            'project_name'=>$project->name,
            'due_date'=>$task->due_date,
        ];
        $response_comments = [];
        foreach ($comments as $comment){
            $comment_admin = User::find($comment->collaborator_id);
            $split_name = explode(' ',$comment_admin->name);
            $avtar_icon_name = null;
            if (count($split_name)>1){
                $avtar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
            }else{
                $avtar_icon_name = substr($comment_admin->name,0,1);
            }
            $response_comments[] = [
                'name'=>$comment_admin->name,
                'comment'=>$comment->comment,
                'avtar_name'=>$avtar_icon_name,
                'date_time'=>Carbon::parse($comment->created_at)->diffForHumans(),
            ];
        }
        return [$response_comments,$response,$assignees];
//        return $response;
//        return view('Epm.Tasks.show',compact('task'));
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
    public function update(Request $request, $id,$board_id)
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
