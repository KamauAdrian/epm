<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
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
        $assignees = $task->assignees;
        $comments = $task->comments;
        $avtar_icon_name = '';
        if($assignees){
            foreach ($assignees as $assignee){
                $split_name = explode(' ',$assignee->name);
                if (count($split_name)>1){
                    $avtar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
                }else{
                    $avtar_icon_name = substr($assignee->name,0,1);
                }
            }
        }

        $response = '<div class="col-md-12">';
        $response .= '<div class="row">';

        $response .= '<div class="col-md-12 d-flex align-items-center mb-4">';
        $response .= '<h1 class="d-inline-block mb-0 font-weight-normal">'.$task->name.'</h1>';
        $response .= '</div>';

        $response .= '</div>';


        $response .= '<div class="row">
                        <div class="table-responsive">
                                <table class="table table-borderless">';

        $response .= '<div class="col-md-12"><tr><div class="row">';
        $response .= '<div class="col-md-3"><td>Assignee:</td></div>';
        if ($avtar_icon_name) {
            $response .= '<div class="col-md-9"><td><button type="button" class="btn btn-icon">' . $avtar_icon_name . '</button>';

            $response .= '<a href="#!" title="Assign new Collaborator">
                            <button type="button" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                        </a>
                        </td></div>';
            $response .= '</div></tr></div>';
        }else{
            $response .= '<div class="col-md-9"><td><a href="#!" title="Assign new Collaborator">
                            <button type="button" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                        </a>
                        </td></div>';
            $response .= '</div></tr></div>';
        }

        $response .= '<div class="col-md-12"><tr><div class="row">';
        $response .= '<div class="col-md-3"><td>Due Date:</td></div>';
        if ($task->due_date) {
            $response .= '<div class="col-md-9"><td>' . $task->due_date . '</td></div>';
        }else{
            $response .= '<div class="col-md-9"><td> <span><i class="fa fa-calendar"></i></span> No Due Date</td></div>';
        }
        $response .= '</div></tr></div>';

        $response .= '<div class="col-md-12"><tr><div class="row">';
        $response .= '<div class="col-md-3"><td>Project:</td></div>';
        $response .= '<div class="col-md-9"><td>'.$project->name. '</td></div>';
        $response .= '</div></tr></div>';

        $response .='            </table>
                        </div>
                    </div>';

        $response .= '</div>';

        $response_comments = $comments;

//        $response_comments = 'well done';

//        $response_comment = '<div class="col-md-12">';
//        $response_comment .= '<div class="row">';
//        $response_comment .= '<div class="table-responsive">
//                                <table class="table table-borderless">';
//
//        if ($comments){
//            $response_comment .= '<div class="col-md-12">';
//            foreach ($comments as $comment){
//                $response_comment .= '<tr><td>'.$comment->message.'</td></tr>';
//            }
//            $response_comment .= '</div>';
//        }
//
//        $response_comment .='    </table>
//                            </div>';
//
//        $response_comment .= '</div>';
//        $response_comment .= '</div>';


        return [$response_comments,$response];
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
