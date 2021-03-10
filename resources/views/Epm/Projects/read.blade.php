@extends('Epm.layouts.master')

@section('styles')
    <style>
        .table-responsive{
            max-height: 100vh;
            max-width: 100%;
            overflow: auto;
        }
        .table-comments{
            max-height: 100vh;
            max-width: 100%;
            overflow: auto;
        }
        .card .tasks :hover{
            background-color: #edf2f7;
        }
        .card {
           width: 25rem;
            word-wrap: break-word
        }
        .card-text {
            word-wrap: break-word;
        }
        .attach{
            border: 1px dashed #7E858E;
            border-radius: 5px;
            padding: 9px;
            color: #7E858E;
        }
        .modal .modal-footer{
            position: sticky;
            bottom: 0;
            background-color: #FBFBFB;
            z-index: 1;
        }
        .modalTop{
            background-color: #7E858E;
        }

    </style>
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center mb-4">
                    <h1 class="d-inline-block mb-0 font-weight-normal">{{$project->name}}</h1>
                </div>
                <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    <a href="{{url('/adm/'.$auth_admin->id.'/project/'.$project->id.'/overview')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Gantt Chat</button>
                    </a>
                    <a href="{{url('/adm/'.$auth_admin->id.'/edit/project/'.$project->id)}}">
                        <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Invite Teammates</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <tbody style="overflow: scroll;">
                            @if($boards)
                                <tr>
                                    @foreach($boards as $board)
                                        <td style="white-space: normal">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <p class="float-left" style="font-size: 14px;">{{$board->name}}</p>
                                                        <button type="button" class=" float-right btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="feather icon-more-horizontal"></i>
                                                        </button>
                                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                            <a href="#!" data-toggle="modal" class="openModalUpdateActivity" data_url="{{"/adm/".$auth_admin->id."/update/activity/".$board->id}}" data_activity_name="{{$board->name}}"><li class="dropdown-item">Edit Activity</li></a>
                                                            <a href="#!"><li class="dropdown-item close-card">Delete Activity</li></a>
                                                        </ul></div>
                                                </div>
                                                <?php $tasks = \App\Models\Board::find($board->id)->tasks; ?>
                                                @foreach($tasks as $task)
                                                    <?php
                                                    $assignees = \App\Models\Task::find($task->id)->assignees;
                                                    //                                                                dd($single_task->assignees);
                                                    $avatar_icon_name = [];
                                                    if ($assignees){
                                                        foreach ($assignees as $assignee){
                                                            $split_name = explode(' ',$assignee->name);
                                                            if (count($split_name)>1){
                                                                $avatar_icon_name[] = $split_name[0];
                                                            }else{
                                                                $avatar_icon_name[] = $assignee->name;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                <div class="col-md-12">
                                                    <div  class="card tasks">
                                                        <div class="card-body">
                                                            <div class="">
                                                                <div class="card-text">{{$task->name}}</div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <div style="font-size: 12px" class="text-small text-muted">Due Date</div>
                                                                <div class="">
                                                                    @if($task->due_date)
                                                                       <span style="font-size: 12px"> {{$task->due_date}}</span>
                                                                    @else
                                                                        <div class=""><i class="fa fa-calendar"></i> No Due Date</div>
                                                                    @endif
                                                                </div>
                                                                <div class="mt-2">
                                                                    <div style="font-size: 12px" class="text-small text-muted">Assignees/Collaborators</div>
                                                                    @if($avatar_icon_name)
                                                                        @foreach($avatar_icon_name as $name)
                                                                            <span class="badge badge-pill badge-success p-2">{{$name}}</span>
                                                                        @endforeach
                                                                    @endif
                                                                        <a href="#!" title="Assign new Collaborators" class="btn btn-icon">
                                                                            <i class="feather icon-plus"></i>
                                                                        </a>
                                                                </div>
                                                            </div>
                                                            <a href="#!" class="stretched-link openModalTask" data-toggle="modal" data-user_id="{{$auth_admin->id}}" data-task_id="{{$task->id}}" data-task_name="{{$task->name}}"  id="openModalForTask{{$task->id}}" ></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="card" style="display: none;" id="card-add-new-task-{{$board->id}}">
                                                    <div class="card-body">
                                                        <form action="{{url('/adm/'.$auth_admin->id.'/create/new/task/board_id='.$board->id)}}" method="post">
                                                            <div class="row">
                                                                @csrf
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Add A New Task To {{$board->name}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input style="width: auto" type="text" class="form-control" name="name" placeholder="Task One" required>
                                                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div project_id="{{$board->project_id}}" class="form-group" id="assignee_{{$board->id}}">
                                                                        <label>Assignee</label>
                                                                        <multiselect v-model="selectedPmo" :options="pmos"
                                                                                     placeholder="Search" track-by="id" label="name"
                                                                                     :searchable="true" :close-on-select="true" multiple>
                                                                        </multiselect>
                                                                        <input type="hidden" name="assignees[]" v-for="pm in selectedPmo" :value="pm.id">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Due Date</label>
                                                                        <input style="width: auto" type="date" class="form-control" name="due_date" required>
                                                                        <span class="text-danger">{{$errors->first('due_date')}}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-mdd-12">
                                                                    <div class="form-group float-right">
                                                                        <input class="btn btn-outline-info" type="submit" value="Add Task">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <a href="#!"><p onclick="addNewTask({{$board->id}})" style="color: #7E858E;" class="text-normal"><span><i class="fa fa-plus"></i></span> Add Task</p></a>
                                            </div>
                                        </td>
                                    @endforeach
                                    <td>
                                        <div class="row" style="display: none;" id="add-new-board">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="col-md-12">
                                                        <form action="{{url('/adm/'.$auth_admin->id.'/create/new/board/project_id='.$project->id)}}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Activity Name</label>
                                                                        <input style="width: auto" type="text" class="form-control" name="name" placeholder="ie To DO List" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group text-left">
                                                                        <input class="btn btn-outline-info" type="submit" value="Create Activity">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <a href="#!"><p onclick="addNewBoard()" style="color: #7E858E;" class="text-normal"><span><i class="fa fa-plus"></i></span> Create Activity</p></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            <div class="modal fade modalTop" id="modalUpdateAssignee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-update-assignees">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="user_id" id="modal-task-assignee-edit-user-id" value="{{$auth_admin->id}}">
                                        <input type="hidden" id="modal-modal-assignee-task-id" name="task_id" value="">
                                        <div project_id="{{$project->id}}" class="form-group" id="collaborators">
                                            <label>Assignee</label>
                                            <multiselect v-model="selectedPmo" :options="pmos"
                                                         placeholder="Search" :track-by="trackBy" label="name"
                                                         :searchable="true" :close-on-select="true" multiple>
                                            </multiselect>
                                            <input type="hidden" name="assignees[]" v-for="pm in selectedPmo" :value="pm.id">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="btn-assign-task" type="submit" class="btn btn-outline-success float-right">
                                                Assign Task
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalTaskDetailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" id="" class="btn btn-outline-info btn-mark-task-complete"></button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mt-4" style="display: none;">
                                    <div class="col-md-12">
                                        <div id="modal-modal-task-task-id"></div>
                                        <div id="modal-modal-task-task-name"></div>
                                        <div id="modal-modal-task-user-id"></div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <form action="#!">
                                            <div class="row task-details">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-4" id="modalTaskDetailedComments">
                                    <h6>Comments & Progress Notes</h6>
                                    <div class="col-md-12 task-comments">
                                        {{--                                        //comments dynamically pulled via ajax request--}}
                                    </div>
                                </div>
                                <div class="row mt-4" id="modalTaskDetailedAttachments">
                                    <h6>Attachments</h6>
                                    <div class="col-md-12">
                                        <div class="  mt-4">
                                            <div class="container task-attachments" style="overflow: auto;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4" id="modalTaskDetailedLinks">
                                    <h6>Links</h6>
                                    <div class="col-md-12">
                                        <div class="  mt-4">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-12  attachment">
                                                        <ol class="list-unstyled task-links">

                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <form id="form-comments">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{--                                                <input type="hidden" name="about">--}}
                                                <input type="hidden" name="user_id" id="modal-footer-user-id" value="">
                                                <input type="hidden" name="task_id" id="modal-modal-comments-task-id" value="">
                                                <input type="hidden" name="csrf_token" id="modal-footer-csrf-token" value="{{csrf_token()}}">
                                                <div id="editor">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn ml-2 attach" type="button" id="add-attachment">
                                                    Add Attachment
                                                </button>
                                                <button class="btn ml-2 attach" type="button" id="add-link">
                                                    Add Link
                                                </button>
                                                <button class="btn btn-outline-info float-right btn-task-comment ml-2" type="submit">
                                                    Post Comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{--                            <div class="col-md-12">--}}
                            {{--                                <div class="container mt-4">--}}
                            {{--                                    <div style="height: 50px" class="row">--}}
                            {{--                                        <div class="col-sm-12  attachment">--}}
                            {{--                                            <div class="card text-center" style="width:auto" id="add-attachment">--}}
                            {{--                                                <a href="#!" class="attach"><span><i class="fa fa-plus"></i> Add an Attachment</span></a>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="col-md-12">--}}
                            {{--                                <div class="container mt-2">--}}
                            {{--                                    <div style="height: 50px" class="row">--}}
                            {{--                                        <div class="col-md-12  attachment">--}}
                            {{--                                            <div class="card text-center" style="width:auto" id="add-link">--}}
                            {{--                                                <a href="#!" class="attach">--}}
                            {{--                                                    <span><i class="fa fa-plus"></i></span> Add a Link--}}
                            {{--                                                </a>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modalTop" id="modalUpdateTaskName" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-update-task-name">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="task-user-id" type="hidden" name="user_id" value="">
                                        <input  id="task-task-id" type="hidden" name="task_id" value="">
                                        <div class="form-group">
                                            <label>Update Task Name</label>
                                            <input type="text" id="task-task-name" class="form-control" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="btn-assign-task" type="submit" class="btn btn-outline-success float-right" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modalTop" id="modalUpdateDueDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-update-due-date">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="modal-modal-date-user-id" type="hidden" name="user_id" value="{{$auth_admin->id}}">
                                        <input  id="modal-modal-date-task-id" type="hidden" name="task_id" value="{{$task->id}}">
                                        <div class="form-group">
                                            <label>Update Task Due Date</label>
                                            <input type="date" class="form-control" name="due_date" value="{{$task->due_date}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="btn-assign-task" type="submit" class="btn btn-outline-success float-right" value="Update">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="ModalUpdateActivity" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="modal-update-activity" action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Activity Name</label>
                                            <input id="form-activity-name" style="width: auto" type="text" class="form-control" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-left">
                                            <input class="btn btn-outline-info" type="submit" value="Update Activity">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                </div>
            </div>
            <div class="modal fade modalTop" id="modalRemoveAssignee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger">Remove Collaborator From task</h5>
                        </div>
                        <div class="modal-footer">
                            <form action="" id="form-delete-user" method="post">
                                @csrf
                                <button data-data="" id="btn-delete-user" type="submit" class="btn btn-outline-success">
                                    Yes Remove
                                </button>
                                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                     </div>
                </div>
            </div>
            <div class="modal fade modalTop" id="modalAddAttachment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-add-attachment" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <h6></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="user_id" value="{{$auth_admin->id}}">
                                        <input type="hidden" id="modal-modal-attachment-task-id" name="task_id" value="">
                                        <div class="form-group">
                                            <label>Add Attachment</label>
                                            <p class="text-small"><b>Please note:</b> Only add PDFs or Images as attachments. For Word, Excel or PowerPoint documents, add the Google Drive link instead.</p>
                                            <input type="file" class="form-control" name="attachment" accept=".pdf,.png,.jpeg,.jpg,.giff,.bpm">
                                            <span class="text-danger">{{$errors->first("attachment")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="btn-assign-task" type="submit" class="btn btn-outline-success float-right" value="Upload">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                     </div>
                </div>
            </div>
            <div class="modal fade modalTop" id="modalAddLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="form-add-link">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <h6></h6>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="user_id" value="{{$auth_admin->id}}">
                                        <input type="hidden"  id="modal-modal-link-task-id" name="task_id" value="">
                                        <div class="form-group">
                                            <label>Add a Link</label>
                                            <input type="text" class="form-control" name="link" placeholder="Paste Your Link Here" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="btn-assign-task" type="submit" class="btn btn-outline-success float-right" value="Add">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                     </div>
                </div>
            </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.openModalUpdateActivity').click(function(event){
                event.preventDefault();
                let url = $(this).attr("data_url");
                let activityName = $(this).attr("data_activity_name");
                let form = $("#modal-update-activity");
                let formActivityName = $("#form-activity-name");
                formActivityName.val(activityName);
                form.attr("action",url);
                console.log(url);
                $("#ModalUpdateActivity").modal('show');
            });
        });

        function openModalRemoveAssignee(){
            $("#modalRemoveAssignee").modal('show');
        }

        function openModalUpdateAssignee(){
            $("#modalTaskDetailed").modal('hide');
            $("#modalUpdateAssignee").modal('show');
        }

        function openModalUpdateTaskName(){
            $("#modalTaskDetailed").modal('hide');
            $("#modalUpdateTaskName").modal('show');
        }
        function openModalUpdateDueDate(){
           // var taskId = document.getElementById('modal-modal-date-task-id');
           // taskId.append(document.getElementById('modal-modal-task-task-id').innerText);
            $("#modalTaskDetailed").modal('hide');
            $("#modalUpdateDueDate").modal('show');
        }
        $('#modalUpdateAssignee').on('show.bs.modal', function () {
            // do something…
            var formUpdateAssignees = document.getElementById('form-update-assignees');
            formUpdateAssignees.onsubmit = function(event) {
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                })
                event.preventDefault();
                var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
                var task_id = $("#modal-modal-assignee-task-id").val();
                var formData = $("#form-update-assignees").serializeArray();
                $.ajax({
                    url: '/adm/'+user_id+'/assign/task/'+task_id+'/new/collaborator',
                    type: 'post',
                    data:formData,
                    success: function(response){
                        $("#modalUpdateAssignee").modal('hide');
                    }
                });

                // No back end to actually submit to!
                // alert('Open the console to see the submit data!');
                return true;
            };
        });
        $('.openModalTask').click(function(event){
            event.preventDefault();
            var taskId=$(this).attr("data-task_id");
            // var taskName=$(this).attr("data-task_name");
            // alert("opening modal with task "+taskId+" details");
            $("#modal-modal-task-task-id").text(taskId);
            // $("#modal-modal-task-task-name").text(taskName);
            $("#modalTaskDetailed").modal('show');
        });
        $('#add-attachment').click(function(event){
            $("#modalTaskDetailed").modal('hide');
            $("#modalAddAttachment").modal('show');
        });
        $('#add-link').click(function(event){
            $("#modalTaskDetailed").modal('hide');
            $("#modalAddLink").modal('show');
        });

        $('#modalUpdateAssignee').on('hidden.bs.modal', function () {
            // do something…
            $("#modalTaskDetailed").modal('show');
        });
        $('#modalUpdateTaskName').on('hidden.bs.modal', function () {
            // do something…
            $("#modalTaskDetailed").modal('show');
        });
        $('#modalUpdateDueDate').on('hidden.bs.modal', function () {
            // do something…
            $("#modalTaskDetailed").modal('show');
        });
        $('#modalAddAttachment').on('hidden.bs.modal', function () {
            // do something…
            $("#modalTaskDetailed").modal('show');

            $('#modalTaskDetailed').animate({
                scrollTop: $('#modalTaskDetailedAttachments')[0].scrollHeight
            }, "slow");
        });

        $('#modalTaskDetailed').on('hidden.bs.modal', function () {
            // location.reload();
        });
        $('#modalTaskDetailed').on('show.bs.modal', function () {
            // alert("modal ready for you");
            $('.task-comments').empty();
            $('.task-attachments').empty();
            $('.task-links').empty();
            var userId ="{{auth()->user()->id}}";
            var taskId = document.getElementById('modal-modal-task-task-id').innerText;
            // console.log("task id = "+taskId+" and user id ="+userId);
            $("#modal-modal-comments-task-id").val(taskId);
            $("#modal-modal-date-task-id").val(taskId);
            // $("#task-task-id").val(taskId);
            $("#modal-modal-assignee-task-id").val(taskId);
            $("#modal-modal-attachment-task-id").val(taskId);
            $("#modal-modal-link-task-id").val(taskId);
            // AJAX request
            $.ajax({
                url: '/adm/'+userId+'/view/task/task_id='+taskId,
                type: 'get',
                data: {
                    id: userId,
                    task_id: taskId,
                },
                success: function([response_task,response_assignees,response_attachments,response_links,response_comments]){

                    $(".btn-mark-task-complete").attr('id','markTask'+response_task.id+'Complete');
                    console.log(response_task.status);
                    if (response_task.status == 0){
                        $(".btn-mark-task-complete").text('Mark Complete');
                    }
                    if(response_task.status == 1){
                        $(".btn-mark-task-complete").text('Completed');
                    }
                    // Add response in Modal body
                    var task_assignees = "";
                    if (response_assignees){
                        response_assignees.forEach(function (assignee){
                            task_assignees+= '<span class="badge badge-pill badge-success p-2">'+assignee+'</span> '
                            // task_assignees+= '<button class="btn btn-icon m-2" onclick="openModalRemoveAssignee()">'+assignee+'</button>'
                        });
                    }else {
                        //do something else
                        task_assignees+= '<p class="">No Assignee</p>'
                    }
                    //attachments section
                    if (response_attachments) {
                        var attachmentsContainer = $('.task-attachments');
                        attachmentsContainer.empty();
                        var rowAttachmentDiv = '';
                        var i, j, temparray, chunk = 2;
                        for (i = 0, j = response_attachments.length; i < j; i += chunk) {
                            temparray = response_attachments.slice(i, i + chunk);
                            rowAttachmentDiv = '<div style="height: 50px" class="row mt-2 mb-2">';
                            var childAttachmentDiv = "";
                            for (x = 0; x < temparray.length; x++) {
                                var attachment = temparray[x];
                                childAttachmentDiv += '<div id="attachment-' + attachment.id + '" class="col-sm-6  attachment"> <div class="card attach" style="width:auto"> <div> <div style="float: left"> <a href="#!" title="' + attachment.full_name + '" class="attachment-download" data-url="' + attachment.url + '"> ' + attachment.name + '</a> </div> <div style="float:right"> <span class="btn btn-icon attachment-download" data-url="' + attachment.url + '"><i class="fa fa-download"></i></span> <span class="btn btn-icon ml-2 attachment-delete" data-id="' + attachment.id + '"><i class="fa fa-times"></i></span> </div> </div> </div> </div>';
                            }
                            rowAttachmentDiv += childAttachmentDiv + '</div>';
                            attachmentsContainer.append(rowAttachmentDiv);
                        }
                    }
                    // links section
                    if (response_links) {
                        var linksContainer = $('.task-links');
                        var linksDiv = '';
                        for (var y = 0; y < response_links.length; y++) {
                            var link = response_links[y];
                            linksDiv += '<li class="attachment" id="link-' + link.id + '"> <div class="card attach" style="width:auto;"> <div class="" style=" width: 90%; white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"> <a target="_blank" href="' + link.name + '" style=""> ' + link.name + '</a> </div> <div class="text-right"> <span class="btn btn-icon ml-2 link-delete" data-id="' + link.id + '"><i class="fa fa-times"></i></span> </div> </div> </li>';
                        }
                        linksContainer.append(linksDiv);
                    }
                    var due_date = response_task.due_date;
                    if (response_task.due_date==null){
                        due_date = 'No Due Date';
                    }
                    var description = response_task.description;
                    $('#modalTaskDetailed .modal-body .task-details').html(
                        '<div class="col-md-12" style="display: none;" id="modal-task-id">'+response_task.id+'</div>'+
                        '<div class="col-md-12">'+
                        '<div class="form-group">'+
                        '<h6 class="text-center" onclick="openModalUpdateTaskName()">'+response_task.name+'</h6>'+
                        '</div>'+
                        '</div>'+
                        '<div class="mt-4">'+
                        '<div style="font-size: 12px" class="text-small text-muted">Due Date</div>'+
                        '<div class="">'+
                        '<span style="font-size: 12px" onclick="openModalUpdateDueDate()">'+due_date+'</span>'+
                        '</div>'+
                        '<div class="mt-2">'+
                        '<div style="font-size: 12px" class="text-small text-muted">Assignees/Collaborators</div>'+
                        '<div class="">'+
                        '<span style="font-size: 12px">'+task_assignees+'</span>'+
                        '<button type="button" class="btn btn-icon" onclick="openModalUpdateAssignee()">+</button>'+
                        '</div>'+
                        '</div>'+
                        '</div>'
                    );
                    // console.log(task_assignees);
                    // console.log(response_comments.length);
                    if (response_comments){
                        response_comments.forEach(function (response_comment){
                            // console.log(response_comment);
                            // var date_time = response_comment.created_at;
                            var commentTaskSection =
                                '<div class="comment mt-4"><div>'+
                                '<button type="button" class="btn btn-icon">'+response_comment.avtar_name+'</button>' +
                                '<span> '+response_comment.name+'<span style="font-size: 10px;color:mediumvioletred"> '+response_comment.date_time+'</span>' +
                                '</span><br>'+
                                '</div>'+
                                '<div class="mt-2 ml-2">'+response_comment.comment+'</div></div>';
                            var comments = $('.task-comments');
                            // console.log(comments);
                            // comments.innerHTML='';
                            comments.append(commentTaskSection);
                        });
                    }
                    $('.attachment-download').click(function(event){
                        var url = $(this).attr('data-url');
                        console.log(url);
                        window.location = url;
                        // No back end to actually submit to!
                        // alert('Open the console to see the submit data!');
                        return true;
                    });
                    $('.attachment-delete').click(function(event){
                        var attachmentId = $(this).attr('data-id');
                        $.ajaxSetup({
                            header:$('meta[name="_token"]').attr('content')
                        })
                        event.preventDefault();
                        var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
                        console.log("attach id"+attachmentId);
                        $.ajax({
                            url: '/adm/'+user_id+'/delete/task/attachment/'+attachmentId,
                            type: 'post',
                            success: function(response){
                                $("#attachment-"+attachmentId).hide();
                                // $("#modalTaskDetailed").modal('show');
                            }
                        });
                        // return true;
                    });
                    $('.link-delete').click(function(event){
                        var linkId = $(this).attr('data-id');
                        $.ajaxSetup({
                            header:$('meta[name="_token"]').attr('content')
                        })
                        event.preventDefault();
                        var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
                        console.log("link id equals"+linkId);
                        $.ajax({
                            url: '/adm/'+user_id+'/delete/task/link/'+linkId,
                            type: 'post',
                            success: function(response){
                                $("#link-"+linkId).hide();
                                // $("#modalTaskDetailed").modal('show');
                            }
                        });
                        // return true;
                    });
                }
            });
            // $('#markTask'+taskId.id+'Complete').click(function (event){
                $(".btn-mark-task-complete").click(function (event){
                    // alert("hey there wat do you want to do next");
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                });
                event.preventDefault();
                alert("click so far so good");
                var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
                $.ajax({
                    url: '/adm/'+user_id+'/mark/task/'+taskId+'/complete',
                    type: 'post',
                    success: function(response){
                        // console.log(response.data.status);
                        if (response.data.status == 0){
                            $(".btn-mark-task-complete").text('Mark Complete');
                        }else{
                            $(".btn-mark-task-complete").text('Completed');
                        }
                    }
                });
                return true;
            });

        });

        $('#modalAddLink').on('hidden.bs.modal', function () {
            // do something…
            $("#modalTaskDetailed").modal('show');
            $('#modalTaskDetailed').animate({
                scrollTop: $('#modalTaskDetailedLinks')[0].scrollHeight
            }, "slow");
        });

        var quill = new Quill('#editor', {
            modules: {
                toolbar: true,
            },
            placeholder: 'Ask a Question or Post an Update...',
            theme: 'snow'
        });
        var formComments = document.getElementById('form-comments');
        var formUpdateTaskName = document.getElementById('form-update-task-name');
        var formUpdateDueDate = document.getElementById('form-update-due-date');
        var formAddAttachment = document.getElementById('form-add-attachment');
        var formAddLink = document.getElementById('form-add-link');
        formComments.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            // var about = document.querySelector('input[name=about]');
            var user_id = {{\Illuminate\Support\Facades\Auth::user()->id}};
            var task_id = $("#modal-modal-comments-task-id").val();
            console.log('wololo this is what i found '+task_id);
            var about_content = quill.root.innerHTML;
            $.ajax({
                url: '/adm/'+user_id+'/add/task/comment/task_id='+task_id,
                type: 'post',
                data: {
                    id: user_id,
                    task_id: task_id,
                    comment: about_content,
                },
                success: function(response){
                    quill.root.innerHTML='';
                    if ($('.task-comments').is(':empty')){
                        var firstComment = '<div class="comment mt-4">'+
                            '<div>'+
                            '<button type="button" class="btn btn-icon">'+response.avtar_name+'</button>' +
                            '<span> '+response.name+'<span style="font-size: 10px;color:mediumvioletred"> '+response.date_time+'</span>' +
                            '</span><br>'+
                            '</div>'+
                            '<div class="mt-2 ml-2">'+response.comment+'</div></div>';
                        var commentSection = $('.task-comments');
                        commentSection.append(firstComment);
                    }else {
                        var newComment = $('.comment');
                        newComment.last().after('<div class="comment mt-4">'+
                            '<div>'+
                            '<button type="button" class="btn btn-icon">'+response.avtar_name+'</button>' +
                            '<span> '+response.name+'<span style="font-size: 10px;color:mediumvioletred"> '+response.date_time+'</span>' +
                            '</span><br>'+
                            '</div>'+
                            '<div class="mt-2 ml-2">'+response.comment+'</div></div>'
                        );
                    }
                    $('#modalTaskDetailed').animate({
                        scrollTop: $('#modalTaskDetailedComments')[0].scrollHeight
                    }, "slow");

                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        formUpdateTaskName.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            var user_id = {{auth()->user()->id}};
            var task_id = $("#task-task-id").val();
            var formData = $(formUpdateTaskName).serializeArray();
            $.ajax({
                url: '/adm/'+user_id+'/update/task/'+task_id+'/name',
                type: 'post',
                data: formData,
                success: function(response){
                    // $("#modalTaskDetailed").modal('hide');
                    $("#modalUpdateTaskName").modal('hide');
                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        formUpdateDueDate.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
            var task_id = $("#modal-modal-date-task-id").val();
            var formData = $("#form-update-due-date").serializeArray();
            $.ajax({
                url: '/adm/'+user_id+'/update/task/'+task_id+'/due_date',
                type: 'post',
                data: formData,
                success: function(response){
                    // $("#modalTaskDetailed").modal('hide');
                    $("#modalUpdateDueDate").modal('hide');
                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        formAddAttachment.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
            var task_id = $("#modal-modal-attachment-task-id").val();
            var formData = new FormData(document.getElementById("form-add-attachment"));
            $.ajax({
                url: '/adm/'+user_id+'/add/task/'+task_id+'/attachment',
                type: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response){
                    if (response){
                        // $("#modalTaskDetailed").modal('hide');
                        $("#modalAddAttachment").modal('hide');

                    }
                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        formAddLink.onsubmit = function(event) {
            // Populate hidden form on submit
            $.ajaxSetup({
                header:$('meta[name="_token"]').attr('content')
            })
            event.preventDefault();
            var user_id = "{{\Illuminate\Support\Facades\Auth::user()->id}}";
            var task_id = $("#modal-modal-link-task-id").val();
            var formData = $("#form-add-link").serializeArray();
            $.ajax({
                url: '/adm/'+user_id+'/add/task/'+task_id+'/link',
                type: 'post',
                data: formData,
                success: function(response){
                    if (response){
                        // $("#modalTaskDetailed").modal('hide');
                        $("#modalAddLink").modal('hide');
                    }

                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        function addNewBoard(){
            var boardForm = document.getElementById('add-new-board');
            if (boardForm.style.display='none'){
                boardForm.style.display='block';
            }
        }

        function addNewTask(id){
            var taskForm = document.getElementById('card-add-new-task-'+id);
            if (taskForm.style.display='none'){
                taskForm.style.display='block';
            }
            new Vue({
                el: "#assignee_"+id,
                components: {
                    Multiselect: window.VueMultiselect.default,
                    axios: window.axios.defaults,
                },
                data() {
                    return {
                        selectedPmo: null,
                        pmos: [],
                    }
                },
                mounted () {
                    this.getAssignees()
                },
                methods:{
                    getAssignees(){
                        axios
                            .get('/list/collaborators/'+this.$el.attributes.project_id.value)
                            .then(response => {
                                this.pmos = response.data;
                                console.log(this.$el.attributes.project_id.value);
                            })
                            .catch(error => {
                                console.log(error)
                                this.errored = true
                            })
                            .finally(() => this.loading = true)
                    },
                },
            });
        }
        new Vue({
            el: "#collaborators",
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    trackBy: 'id',
                    initialValues: [9,13],
                    selectedPmo: null,
                    pmos: [],
                }
            },
            mounted () {
                this.getAssignees();
            },
            methods:{
                getAssignees(){
                    axios
                        .get('/list/collaborators/'+this.$el.attributes.project_id.value)
                        .then(response => {
                            this.pmos = response.data;
                        }).catch(error => {
                            console.log(error);
                            this.errored = true;
                        }).finally(() => this.loading = true);
                },
            },
            watch: {
                initialValues: {
                    immediate: true,
                    handler(values) {
                        this.selectedPmo = this.pmos.filter(x => values.includes(x[this.trackBy]));
                    }
                }
            },
        });
        $(document).ready(function (){
            $('#tableProjects').DataTable();
        });
        $('#myDataTable').DataTable();

        // var Delta = Quill.import('delta');
        // var taskDesc = new Quill('#task-description-add', {
        //     modules: {
        //         toolbar: true
        //     },
        //     placeholder: 'Add a Short Task Description',
        //     theme: 'snow'
        // });
        //
        // // Store accumulated changes
        // var change = new Delta();
        // taskDesc.on('text-change', function(delta) {
        //     change = change.compose(delta);
        // });
        // //
        // // // Save periodically
        // setInterval(function() {
        //     if (change.length() > 0) {
        //         console.log('Saving changes', change);
        //         // Send partial changes
        //         // $.post('/your-endpoint', {
        //         //     partial: JSON.stringify(change)
        //         // });
        //         /*
        //         Send partial changes
        //         $.post('/your-endpoint', {
        //           partial: JSON.stringify(change)
        //         });
        //
        //         Send entire document
        //         $.post('/your-endpoint', {
        //           doc: JSON.stringify(quill.getContents())
        //         });
        //         */
        //         change = new Delta();
        //     }
        // }, 5*1000);
        // //
        // // // Check for unsaved data
        // window.onbeforeunload = function() {
        //     if (change.length() > 0) {
        //         return 'There are unsaved changes. Are you sure you want to Leave?';
        //     }
        // }
    </script>
@endsection

