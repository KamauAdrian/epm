@extends('Epm.SuAdmins.layouts.list')
@inject('teamTrainers', 'App\Models\TeamTrainer')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Classes</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/class')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Create New Class</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php
                $auth_admin = auth()->user();
                ?>
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

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sessionClasses" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Classes</th>
                                    <th>Description</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                @if($classes)
                                    <tbody>
                                    @foreach($classes as $class)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$class->name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$class->description}}</td>
                                            <td class="text-right">
                                                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/edit/class/class_id='.$class->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                                            <span><i class="fa fa-pencil-alt"></i></span>
                                                        </a>
                                                        <a href="#!" data-url="{{url('/adm/'.$auth_admin->id.'/delete/class/class_id='.$class->id)}}" class="btn btn-sm btn-outline-danger deleteClass" data-toggle="modal" data-target="#deleteClass" title="Delete">
                                                            <span><i class="fa fa-trash"></i></span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="deleteClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{--                    {{url('/adm-delete-pm','hiddenValue')}}--}}
                                    <h5 class="text-danger">Are you sure you want to delete this Class?</h5>
                                </div>
                                <div class="modal-footer">
                                    <form id="deleteAdminForm" action="" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">Yes Delete</button>
                                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/class')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Create New Class</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#sessionClasses').DataTable();
        } );
        $(function () {
            $(".deleteClass").click(function () {
                var url = $(this).attr('data-url');
                console.log('this is the url'+ url);
                $("#deleteAdminForm").attr("action", url);
            })
        });
    </script>
@endsection
