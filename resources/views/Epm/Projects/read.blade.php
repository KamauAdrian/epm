@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <style>
        .table-responsive{
            max-height: 100vh;
            max-width: 100%;
            overflow: auto;
        }
        .card :hover{
            background-color: #edf2f7;
        }
        .card .card-text{
            word-wrap: break-word;
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
                                                    <div class="card" style="color: #7E858E; max-width: 20rem;">
                                                        <div class="card-body">
                                                                <?php
                                                                $assignees = \App\Models\Task::find($task->id)->assignees;
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
                                                                    <p class="card-text">
                                                                        {{$task->name}}
                                                                    </p>
{{--                                                                            <span class="avtar" >{{$avatar_icon_name}}</span>--}}
                                                                            @if($assignees)
                                                                                <span class="avtar bg-blue-1" >{{$avatar_icon_name}}</span>
                                                                            @endif
                                                                            {{$task->due_date}}
                                                                <a href="#!" class="stretched-link openModalTask" data-toggle="modal" data-data="{{$task->id}}"  id="openModalTask{{$task->id}}" ></a>
                                                        </div>
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
                        </tbody>
                    </table>
                </div>
            <div class="modal fade" id="modalTaskDetailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="modal_task_id" data-id="">

                                id found on parent element


{{--                            {{$user->name}}--}}
                            {{--                    {{url('/adm-delete-pm','hiddenValue')}}--}}
                            <h5 class="text-danger">Are you sure you want to delete this Admin?</h5>
                        </div>
                        <div class="modal-footer">
                            <form action="" id="form-delete-user" method="post">
                                @csrf
                                <button data-data="" id="btn-delete-user" type="submit" class="btn btn-outline-success">
                                    Yes Delete
                                </button>
                                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
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
        $(function () {
            $(".openModalTask").click(function () {
                var id = $(this).attr('data-data');
                <?php \App\Models\User::find([$(this).attr('data-data')]) ?>
                $("#modal_task_id").attr("data-id",id);
                $("#modalTaskDetailed").modal('show');
                // console.log('this is the id'+ id);
            });
        });
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

