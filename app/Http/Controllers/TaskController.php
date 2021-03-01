<?php

namespace App\Http\Controllers;

use App\Jobs\ProjectCreatedJob;
use App\Jobs\TaskCompletedJob;
use App\Mail\TaskCompleted;
use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'due_date'=>'required',
        ]);
        $admin = User::find($id);
        $board = Board::find($board_id);
        $task = $request->all();
        $new_task = new Task();
        $new_task->name = $task['name'];
        $new_task->due_date = $task['due_date'];
        $new_task->creator_id = $admin->id;
        $new_task->board_id = $board->id;
        $new_task->project_id = $board->project_id;
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
        $response_task = null;
        $response_assignees = null;
        $response_attachments = null;
        $response_links = null;
        $response_comments = null;
        $task = Task::find($task_id);
        if ($task){
            $response_task = $task;
            $board = $task->board;
            $project = Project::find($board->project_id);
            $project_boards = $project->boards;
            $comments = $task->comments;
            $attachments = $task->attachments;
            if ($attachments){
                foreach ($attachments as $attachment){
                    $response_attachments[] = [
                        "id" => $attachment->id,
                        "name" => mb_strimwidth($attachment->name,0,25,"..."),
                        "full_name" => $attachment->name,
                        "url" => $attachment->url,
                    ];
                }
//                $response_attachments = $task->attachments;
            }
            if ($task->links){
                $response_links = $task->links;
            }
            if($task->assignees){
                foreach ($task->assignees as $task_assignee){
                    $split_name = explode(' ',$task_assignee->name);
                    if (count($split_name)>1){
                        $response_assignees[] = $split_name[0];
                    }else{
                        $response_assignees[]=$task_assignee->name;
                    }
                }
            }
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
        }

        return [$response_task,$response_assignees,$response_attachments,$response_links,$response_comments];
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
    public function update_assignees(Request $request, $id,$task_id)
    {
//        dd($request->all());
        $task = Task::find($task_id);
        if ($task){
            $assignees = $request->assignees;

            if ($task->assignees){
                $task->assignees()->detach($task->assignees);
                $task->assignees()->attach($assignees);
                $response["status_code"]= 0;
                $response["response_message"]= "Assignees Updated Successfully";
                $response["response_data"]= $task;
            }
        }
        return  $response;
//        dd(count($task->assignees),$assignees);
    }

    public function update_due_date(Request $request, $id,$task_id)
    {
        $task = Task::find($task_id);
        $due_date = [
            'due_date'=>$request->due_date,
        ];
        $response = null;
        if ($task->update($due_date)){
            $response = 'Task Due Date Updated Successfully';
        }
        return $response;
    }

    public function mark_complete($id,$task_id)
    {
        $response = [];
        $task = Task::find($task_id);
        if ($task){
            $status = $task->status;
            $collaborators = $task->project->collaborators;
            if ($status==0){
                $data = [
                    'status'=>1,
                    'completion_date'=>date("Y-m-d"),
                ];
                $task->update($data);
                $message="Complete";
                foreach ($collaborators as $collaborator){
                    //dispatch send Task completed emails
                    $updated_task = [
                        'name'=>$collaborator->name,
                        'task'=>$task->name,
                        'message'=>$message
                    ];
                    $params=[];
                    $params['email']=$collaborator->email;
                    $params['updated_task']=$updated_task;
                    dispatch(new TaskCompletedJob($params));
                   // TaskCompletedJob::dispatch($params);

                }
            }else{
                $data = [
                    'status'=>0,
                    'completion_date'=>null,
                ];
                $task->update($data);

                $message="In-Complete";
                foreach ($collaborators as $collaborator){
                    //dispatch send Task completed emails
                    $params=[];
                    $updated_task = [
                        'name'=>$collaborator->name,
                        'task'=>$task->name,
                        'message'=>$message
                    ];
                    $params['email']=$collaborator->email;
                    $params['updated_task']=$updated_task;
                    dispatch(new TaskCompletedJob($params));
//                    TaskCompletedJob::dispatch($params);
//
                }
            }

        }

        $response["result_code"]=0;
        $response["message"]="Status Updated Successfully";
        $response["data"]=$task;


        return $response;
    }

    public function complete_tasks(){
        $tasks = Task::all();
        $complete_tasks = Task::where('status',1)->get();
        $result = round((count($complete_tasks)*100)/count($tasks),2);
        return response()->json($result);
    }
    public function incomplete_tasks(){
        $tasks = Task::all();
        $inComplete_tasks = Task::where('status',0)->get();
        $result = round((count($inComplete_tasks)*100)/count($tasks),2);
        return response()->json($result);
    }
    public function overdue_tasks(){
        $tasks = Task::all();
        $today = date('Y-m-d');
        $overdue_tasks = [];
        foreach ($tasks as $task){
            if ($task->due_date<$today && $task->status==0){
                $overdue_tasks[] = $task;
            }
        }
        $result = round((count($overdue_tasks)*100)/count($tasks),2);
        return response()->json($result);
    }
    public function open_tasks(){
        $tasks = Task::all();
//        $result = round((count($complete_tasks)*100)/count($tasks),2);
        $result = count($tasks);
        return response()->json($result);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


    }
}
