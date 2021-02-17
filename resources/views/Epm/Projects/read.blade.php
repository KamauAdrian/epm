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
        .card :hover{
            background-color: #edf2f7;
        }
        .card {
           width: 25rem;
            word-wrap: break-word
        }
        .card-text {
            word-wrap: break-word;
        }
        .add-attachment{
            border: 1px dashed #7E858E;
            padding: 20px;
            border-radius: 2%;
            color: #7E858E;
        }
        .modal .modal-footer{
            position: sticky;
            bottom: 0;
            background-color: #FBFBFB;
            z-index: 1;
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
{{--                    <p>Due {{date('l dS M Y',strtotime($project->due_date))}}</p>--}}
                    <a href="{{url('/adm/'.$auth_admin->id.'/edit/project/'.$project->id)}}">
                        <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Invite Teammates</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <center>
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="text-success"><h5>{{session()->get('success')}}</h5></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </center>
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
                                                    <h5 style="font-size: 14px;">{{$board->name}}</h5>
                                                </div>
                                                <?php $tasks = \App\Models\Board::find($board->id)->tasks; ?>
                                                @foreach($tasks as $task)
                                                    <?php
                                                    $assignees = \App\Models\Task::find($task->id)->assignees;
                                                    //                                                                dd($single_task->assignees);
                                                    $avatar_icon_name = null;
                                                    if ($assignees){
                                                        foreach ($assignees as $assignee){
                                                            $split_name = explode(' ',$assignee->name);
                                                            if (count($split_name)>1){
                                                                $avatar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
                                                            }else{
                                                                $avatar_icon_name = substr($assignee->name,0,1);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                <div class="col-md-12">
                                                    <div  class="card">
                                                        <div class="card-body">

                                                            <div class="">
                                                                <div class="card-text">{{$task->name}}</div>
                                                            </div>
                                                            <div class="mt-4">

                                                                <div class="">
                                                                    @if($task->due_date)
                                                                        {{$task->due_date}}
                                                                    @else
                                                                        <div class=""><i class="fa fa-calendar"></i> No Due Date</div>
                                                                    @endif
                                                                </div>

                                                                <div class="mt-2">
                                                                    @if($avatar_icon_name)
                                                                        <button class="btn btn-icon" >{{$avatar_icon_name}}</button>
                                                                    @endif
                                                                        <a href="#!" title="Assign new Collaborators" class="btn btn-icon">
                                                                            <i class="feather icon-plus"></i>
                                                                        </a>
                                                                </div>

                                                            </div>
                                                            <a href="#!" class="stretched-link openModalTask" data-toggle="modal" data-user_id="{{$auth_admin->id}}" data-task_id="{{$task->id}}"  id="openModalTask{{$task->id}}" ></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="row">
                                                <div class="card" style="display: none;" id="card-add-new-task-{{$board->id}}">
                                                    <div class="card-body">
                                                        <form action="{{url('/adm/'.$auth_admin->id.'/create/new/task/board_id='.$board->id)}}" method="post">
                                                            @csrf
                                                            <label>Add A New Task To {{$board->name}}</label>
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
                                                                    <input style="width: auto" type="date" class="form-control" name="due_date" placeholder="Task One">
                                                                </div>
                                                            </div>
                                                            <div class="form-group float-right">
                                                                <input class="btn btn-outline-primary" type="submit" value="Add Task">
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
                                                    <form action="{{url('/adm/'.$auth_admin->id.'/create/new/board/project_id='.$project->id)}}" method="post">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input style="width: auto" type="text" class="form-control" name="name" placeholder="ie To DO List" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group float-right">
                                                            <input class="btn btn-outline-primary" type="submit" value="Create Board">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <a href="#!"><p onclick="addNewBoard()" style="color: #7E858E;" class="text-normal"><span><i class="fa fa-plus"></i></span> Create Board</p></a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            <div class="modal fade" id="modalTaskDetailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn btn-outline-info"><span><i class="fa fa-check"></i></span> Mark Complete</button>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <form action="#!">
                                            <div class="row task-details">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-4 mb-4">
                                    <h6>Attachments</h6>
                                    <div class="col-md-12 task-attachments">
                                        <div class="attachment mt-4">
                                            <div class="col-auto">
                                                <a href="#!" class="add-attachment">
                                                    <span><i class="fa fa-plus"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <h6>Links</h6>
                                    <div class="col-md-12 task-attachments">
                                        <div class="attachment mt-4">
                                            <div class="col-auto">
                                                <a href="#!" class="add-attachment">
                                                    <span><i class="fa fa-plus"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <h6>Comments & Progress Notes</h6>
                                    <div class="col-md-12 task-comments">
{{--                                        //comments dynamically pulled via ajax request--}}
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
                                                <input type="hidden" name="task_id" id="modal-footer-task-id" value="">
                                                <input type="hidden" name="csrf_token" id="modal-footer-csrf-token" value="{{csrf_token()}}">
                                                <div id="editor">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-outline-info float-right btn-task-comment" type="submit">
                                                    Comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.openModalTask').click(function(event){
                event.preventDefault();
                $('.task-comments').empty();
                // console.log($('.task-comments').innerHTML.length);

                var userId = $(this).data('user_id');
                var taskId = $(this).data('task_id');
                var modalUserId = document.getElementById('modal-footer-user-id');
                var modalTaskId = document.getElementById('modal-footer-task-id');
                // AJAX request
                $.ajax({
                    url: '/adm/'+userId+'/view/task/task_id='+taskId,
                    type: 'get',
                    data: {
                        id: userId,
                        task_id: taskId,
                    },
                    success: function([response_comments,response,assignees]){
                        // Add response in Modal body
                        console.log(assignees);

                        let task_assignees = "";
                        assignees.forEach(function (assignee){
                            task_assignees+= '<button type="button" class="btn btn-icon m-2">'+assignee+'</button>'+
                            '<button type="button" class="btn btn-icon">+</button>'
                        });

                        if(assignees.length<1)
                        {
                            task_assignees="<div>No One assigned yet</div>";
                        }
                        var due_date = response.due_date;
                        if (response.due_date==null){
                            due_date = 'No Due Date';
                        }

                        $('#modalTaskDetailed .modal-body .task-details').html(
                            '<div class="col-md-12"><div class="form-group"><h6 class="text-center">'+response.task_name+'</h6></div></div>'+
                            '<div class="col-md-3"><div class="form-group"><p>Assignee: </p></div></div>'+
                            '<div class="col-md-9"><div class="form-group">'+task_assignees+'</div></div>'+
                            '<div class="col-md-3"><div class="form-group"><p>Due Date</p></div></div>'+
                            '<div class="col-md-9"><div class="form-group"><p>'+due_date+'</p></div></div>'
                        );



                        // console.log(task_assignees);
                        // console.log(response_comments.length);
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
                        // pass user id and task id to modal footer
                        modalUserId.value = userId;
                        modalTaskId.value = taskId;
                        // Display Modal
                        $("#modalTaskDetailed").modal('show');
                    }
                });
            });
        });

        var quill = new Quill('#editor', {
            modules: {
                toolbar: true,
            },
            placeholder: 'Ask a Question or Post an Update...',
            theme: 'snow'
        });
        var form = document.getElementById('form-comments');
        // console.log(form);
        form.onsubmit = function(event) {
            // Populate hidden form on submit
            event.preventDefault();
            // var about = document.querySelector('input[name=about]');
            var user_id = document.querySelector('input[name=user_id]').value;
            var task_id = document.querySelector('input[name=task_id]').value;
            var _token   = document.querySelector('input[name=csrf_token]').value;
            var about_content = quill.root.innerHTML;
            console.log(user_id,task_id);

            $.ajax({
                url: '/adm/'+user_id+'/add/task/comment/task_id='+task_id,
                type: 'post',
                data: {
                    id: user_id,
                    task_id: task_id,
                    _token: _token,
                    comment: about_content,
                },
                success: function(response){
                    quill.root.innerHTML='';
                    if ($('.task-comments').is(':empty')){
                        var firstComment = '<div class="comment mt-4">'+
                            '<div>'+
                            '<button type="button" class="btn btn-icon">PR</button>' +
                            '<span> '+response.collaborator_name+'<span style="font-size: 10px;color:mediumvioletred"> just now</span>' +
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
                }
            });

            // No back end to actually submit to!
            // alert('Open the console to see the submit data!');
            return true;
        };
        // $('.btn-task-comment').click(function(event){
        //     event.preventDefault();
        //     var about = document.querySelector('input[name=about]');
        //     var user_id = document.querySelector('input[name=user_id]').value;
        //     var task_id = document.querySelector('input[name=task_id]').value;
        //     var _token   = document.querySelector('input[name=csrf_token]').value;
        //     console.log(about,user_id,task_id);
        //     about.value = JSON.stringify(quill.getContents());
        //     $.ajax({
        //         url: '/adm/'+user_id+'/add/task/comment/task_id='+task_id,
        //         type: 'post',
        //         data: {
        //             id: user_id,
        //             task_id: task_id,
        //             _token: _token,
        //         },
        //         success: function(response){
        //             if (response){
        //                 quill.root.innerHTML('');
        //             }
        //         }
        //     });
        //
        //     // No back end to actually submit to!
        //     // alert('Open the console to see the submit data!');
        //     return false;
        // });
        // var Delta = Quill.import('delta');
        // var quill = new Quill('#editor', {
        //     modules: {
        //         toolbar: true
        //     },
        //     placeholder: 'Ask a Question or Post an Update...',
        //     theme: 'snow'
        // });
        //
        // // Store accumulated changes
        // var change = new Delta();
        // quill.on('text-change', function(delta) {
        //     change = change.compose(delta);
        // });
        //
        // // Save periodically
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
        //
        // // Check for unsaved data
        // window.onbeforeunload = function() {
        //     if (change.length() > 0) {
        //         return 'There are unsaved changes. Are you sure you want to leave?';
        //     }
        // }
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
            }).$mount('#assignee_'+id)
        }
        $(document).ready(function (){
            $('#tableProjects').DataTable();
        });
        $('#myDataTable').DataTable();
    </script>
@endsection

