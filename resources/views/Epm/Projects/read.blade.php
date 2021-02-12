@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <style>
        .table-responsive{
            max-height: 100vh;
            max-width: 100%;
            overflow: auto;
        }
        a .card :hover{
            background-color: #edf2f7;
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
                    <a href="#!">
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
                        <tr>
                            @if($boards)
                                @foreach($boards as $board)
                                    <td>
                                        <div class="row">
                                            <h5 style="font-size: 14px;">{{$board->name}}</h5>
                                        </div>
                                        <?php $tasks = \App\Models\Board::find($board->id)->tasks; ?>
                                        @foreach($tasks as $task)
                                            <div class="row">
                                                <a href="#!">
                                                    <div class="card rounded" style="color: #7E858E">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <?php
                                                                $single_task = \App\Models\Task::find($task->id);
//                                                                dd($single_task->assignees);
                                                                $avatar_icon_name = '';
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
                                                                    {{$task->name}}
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
{{--                                                                            <span class="avtar" >{{$avatar_icon_name}}</span>--}}
                                                                            <span class="avtar" >{{$task->name}}</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            {{$task->due_date}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{--                                                            <form action="#!">--}}
                                                                {{--                                                                <?php--}}
                                                                {{--                                                                $assignees = \App\Models\Task::find($task->id)->assignees;--}}
                                                                {{--                                                                $assignees_ids = [];--}}
                                                                {{--                                                                $assignees_names = [];--}}
                                                                {{--                                                                foreach ($assignees as $assignee){--}}
                                                                {{--                                                                    $assignees_ids[] = $assignee->id;--}}
                                                                {{--                                                                    $assignees_names[] = $assignee->name;--}}
                                                                {{--                                                                }--}}

                                                                {{--                                                                if (count($assignees_names)>1){--}}
                                                                {{--                                                                    $names = implode(',',$assignees_names);--}}
                                                                {{--                                                                }else{--}}
                                                                {{--                                                                    $names = $assignees_names;--}}
                                                                {{--                                                                }--}}
                                                                {{--                                                                ?>--}}
                                                                {{--                                                                <div class="col-md-12">--}}
                                                                {{--                                                                    <div class="form-group">--}}
                                                                {{--                                                                        <label>Task Name</label>--}}
                                                                {{--                                                                        <input style="width: auto" type="text" class="form-control" name="name" value="{{$task->name}}" placeholder="Project One" readonly>--}}
                                                                {{--                                                                    </div>--}}
                                                                {{--                                                                </div>--}}
                                                                {{--                                                                <div class="col-md-12">--}}
                                                                {{--                                                                    <div class="form-group">--}}
                                                                {{--                                                                        <label>Task Due Date</label>--}}
                                                                {{--                                                                        <input style="width: auto" type="date" class="form-control" value="{{$task->due_date}}" name="due_date" readonly>--}}
                                                                {{--                                                                    </div>--}}
                                                                {{--                                                                </div>--}}
                                                                {{--                                                            </form>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
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
                            @endif
                            <td>
                                <div class="row" style="display: none;" id="add-new-board">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{url('/adm/'.$auth_admin->id.'/create/new/board/project_id='.$project->id)}}" method="post">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input style="width: auto" type="text" class="form-control" name="name" placeholder="Project One" required>
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
                        </tbody>
                    </table>
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
        {{--var assigned = <?php echo json_encode($assignees_ids); ?>--}}
        {{--for(var i=0; i<assigned.length; i++){--}}
        {{--    alert(assigned[i]);--}}
        {{--}--}}
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

    </script>
@endsection
