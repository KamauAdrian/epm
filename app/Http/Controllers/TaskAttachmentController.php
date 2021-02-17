<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;

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
        $file = $request->file('attachment');
        if ($file->isValid()){
            $fileName = $file->getClientOriginalName();
            $file->move('Tasks/Attachments',$fileName);
        }
        $attachment = new TaskAttachment();
        $attachment->name = $fileName;
        $attachment->task_id = $task->id;
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
    public function destroy($id)
    {
        //
    }
}
