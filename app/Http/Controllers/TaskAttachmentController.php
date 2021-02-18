<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $task = Task::find($task_id);
        if(!$task)
        {
            $response["result_code"]=1;
            $response["message"] = 'Attachment Uploaded Successfully';
            $response["data"] = [];

            return $response;
        }
        $fileName = '';
        $file_path = '';
        $file = $request->file('attachment');
        if ($file->isValid()){
            $fileName = $file->getClientOriginalName();
            $path=$file->move('Tasks/Attachments',$fileName);
            $file_path=url('/')."/".$path->getPathName();
        }
        $attachment = new TaskAttachment();
        $attachment->name = $fileName;
        $attachment->task_id = $task->id;
        $attachment->url = $file_path;
        if ($attachment->save()){
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