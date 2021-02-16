@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-center mb-4">
                    <h1 class="d-inline-block mb-0 font-weight-normal">{{$task->name}}</h1>
                </div>
                <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    <button type="button" class="btn btn-outline-info"><span><i class="fa fa-check"></i></span> Mark Complete</button>
                    {{--                    <a href="#!">--}}
                    {{--                        <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
                    {{--                    </a>--}}
                </div>
            </div>
            <div class="row">
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
            <div class="row">
                <div class="table-responsive">
                    <form action="#!" method="post">
                        @csrf
                        <table class="table table-borderless">
                            <?php
//                            $task = \App\Models\Task::find($task->id);
                            $board = \App\Models\Task::find($task->id)->board;
                            $project = \App\Models\Project::find($board->project_id);
                            $project_boards = $project->boards;
                            $assignees = \App\Models\Task::find($task->id)->assignees;
                            $comments = $task->comments;
//                            dd($comments);
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
                            ?>
                            <tr>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <td><label>Assignee</label></td>
                                    </div>
                                    <div class="col-md-9">
                                        <td>
                                            <span class="avtar text-blue-2 bg-blue-1">
                                                {{$avtar_icon_name}}
                                            </span>
                                        </td>
                                    </div>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <td><label>Due Date</label></td>
                                    </div>
                                    <div class="col-md-9">
                                        <td>
                                            @if($task->due_date)
                                                {{$task->due_date}}
                                            @else
                                                <p><span><i class="fa fa-calendar"></i></span> No Due Date</p>
                                            @endif
                                        </td>
                                    </div>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <td>
                                            <label>Projects</label>
                                        </td>
                                    </div>
                                    <div class="col-md-9">
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <p>{{$project->name}}</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" value="{{$board->name}}">
                                                </div>
                                            </div>
                                        </td>
                                    </div>
                                </div>
                            </tr>
                            <tr>
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <td>
                                            <label>Description</label>
                                        </td>
                                    </div>
                                    <div class="col-md-9">
                                        <td>
                                            <textarea name="task_desc" id="" cols="95" rows="5"></textarea>
                                        </td>
                                    </div>
                                </div>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <td colspan="2">Comments</td>
                        </tr>
                        </thead>
                        @if($comments)
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->comment}}</td> <td>{{$comment->from}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="card" style="display: none;" id="card-add-new-sub-task-{{$task->id}}">
                    <div class="card-body">
                        <form action="{{url('/adm/'.$auth_admin->id.'/create/new/sub/task/task_id='.$task->id)}}" method="post">
                            @csrf
                            <label>Add A New Sub Task To {{$task->name}}</label>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input style="width: auto" type="text" class="form-control" name="name" placeholder="Task One" required>
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $board = \App\Models\Task::find($task->id)->board;
                                ?>
                                <div project_id="{{$board->project_id}}" class="form-group" id="assignee_{{$task->id}}">
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
                                <input class="btn btn-outline-primary" type="submit" value="Add Sub Task">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <a href="#!"><p onclick="addNewSubTask({{$task->id}})" style="color: #7E858E;" class="text-normal"><span><i class="fa fa-plus"></i></span> Add Sub Task</p></a>--}}
{{--            </div>--}}
            <div class="row">

            </div>
            </div>
        </div>
        @endsection

        @section('js')
            <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
            <script src="{{url('assets/dist/vue.js')}}"></script>
            <script src="{{url('assets/dist/axios.js')}}"></script>
            {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
            <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
            <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
            <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
            <script>

                function addNewSubTask(id){
                    var taskForm = document.getElementById('card-add-new-sub-task-'+id);
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

                    $(document).on('click','#addNewBoard', function (){
                        var form = $('#form-add-board');
                        form.style.display='none';
                    });
                });

            </script>
@endsection
