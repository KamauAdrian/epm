@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
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
                        <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Add Collaborators</button>
                    </a>
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
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            @if($boards)
                                @foreach($boards as $board)
                                    <td>

                                            <div class="row">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 style="font-size: 14px;">{{$board->name}}</h5>
                                                        <form action="{{url('/adm/'.$auth_admin->id.'/create/new/board/project_id='.$project->id)}}" class="form-add-board" method="post" style="display: block;">
                                                            @csrf
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input style="width: auto" type="text" class="form-control" name="name" placeholder="Project One">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div board_id="{{$board->project_id}}" class="form-group assignee">
                                                                    <label>Assignee</label>
                                                                    <multiselect v-model="selectedPmo" :options="pmos"
                                                                                 placeholder="Search" trackBy="id" label="name"
                                                                                 :searchable="true" :close-on-select="true" multiple>
                                                                    </multiselect>
                                                                    <input type="hidden" name="assignee[]" v-for="pm in selectedPmo" :value="pm.id">
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
                                                add task
                                            </div>
                                    </td>
                                @endforeach
                            @endif
                            <td>
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{url('/adm/'.$auth_admin->id.'/create/new/board/project_id='.$project->id)}}" method="post" style="display: block;" id="form-add-board">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input style="width: auto" type="text" class="form-control" name="name" placeholder="Project One">
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
                                    <a href="#" id="addNewBoard" class="text-normal"><span><i class="fa fa-plus"></i></span> Add a new Board</a>
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
                        .get('/list/collaborators/'+this.$el.attributes.board_id.value)
                        .then(response => {
                            this.pmos = response.data;
                            console.log('this.$el.attributes.project_id.value');
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('.assignee')

        $(document).ready(function (){
            $('#tableProjects').DataTable();

            $(document).on('click','#addNewBoard', function (){
                var form = $('#form-add-board');
                form.style.display='none';
            });
            // function addNewBoard(){
            //     var form = document.getElementById('form-add-board');
            //     form.style.display='block';
            //     // $('#form-add-board').style.display='none';
            // }

            // function showInputSupplies(){
            //     var yes = document.getElementById('office_supplied');
            //     var no = document.getElementById('office_not_supplied');
            //     var supplies = document.getElementById('supplies_received');
            //     if (yes.checked==true){
            //         supplies.style.display='block';
            //     }
            // }
        });

    </script>
@endsection
