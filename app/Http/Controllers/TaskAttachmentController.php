<?php

namespace App\Http\Controllers;

use App\Jobs\TaskAttachmentAddedJob;
use App\Jobs\TaskLinkAddedJob;
use App\Mail\TaskAttachmentAdded;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TaskAttachmentController extends Controller
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
    public function store(Request $request, $id,$task_id)
    {
        dd($request->all());
        $this->validate($request,[

        ]);
        $task = Task::find($task_id);
        if(!$task)
        {
            $response["result_code"]=1;
            $response["message"] = 'Attachment Uploaded Successfully';
            $response["data"] = [];

            return $response;
        }
//        $this->validate($request,[
//            "attachment"=>"required|mimes:jpeg,png,jpg,zip,pdf"
//        ]);
        $fileName = '';
        $file_path = '';
        $file = '';
        if ($request->hasFile('attachment')){
            $file = $request->file('attachment');
        }
        if ($file && $file->isValid()){
            $fileName = $file->getClientOriginalName();
            $path=$file->move('Tasks/Attachments',$fileName);
            $file_path=url('/')."/".$path->getPathName();
        }
        $attachment = new TaskAttachment();
        $attachment->name = $fileName;
        $attachment->task_id = $task->id;
        $attachment->creator_id = $request['user_id'];
        $attachment->url = $file_path;
        if ($attachment->save()){
            $collaborators = $task->project->collaborators;
            foreach ($collaborators as $collaborator){

                $new_attachment = [
                    'name'=>$collaborator->name,
                    'attachment_creator'=>$attachment->owner->name,
                    'task'=>$task->name,
                ];
                $params=[];
                $params['email']=$collaborator->email;
                $params['new_attachment']=$new_attachment;
                dispatch(new TaskAttachmentAddedJob($params));
//                Mail::to($collaborator->email)->send(new TaskAttachmentAdded($new_attachment));
            }
            $response["result_code"]=0;
            $response["message"] = "Attachment Uploaded Successfully";
            $response["data"] = $attachment;


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
    public function destroy($id,$attachment_id)
    {
        $response = '';
        if (TaskAttachment::find($attachment_id)){
            $attachment = TaskAttachment::find($attachment_id);
           $task = $attachment->task;
           $deleted = DB::table('task_attachments')->where('id',$attachment->id)->where('task_id',$task->id)->delete();
           if ($deleted){
               $response = 'Attachment Deleted';
           }

        }

        return $response;
    }
}
