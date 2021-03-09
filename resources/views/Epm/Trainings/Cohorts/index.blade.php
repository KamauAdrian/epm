@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Cohorts</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/cohort')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Create New Cohort</button>
                    </a>
                @endif
{{--                <a href="#!">--}}
{{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sessionClasses" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Cohort</th>
                                    <th>Description</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                @if($cohorts)
                                    <tbody>
                                    @foreach($cohorts as $cohort)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$cohort->category}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{$cohort->name}}
                                            </td>
                                            <td>{{$cohort->description}}</td>
                                            <td class="text-right">
                                                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/edit/cohort/'.$cohort->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                                            <span><i class="fa fa-pencil-alt"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-danger openModalDeleteCohort" data_url="{{url('/adm/'.$auth_admin->id.'/delete/cohort/'.$cohort->id)}}" data-toggle="modal" title="Delete">
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
                <div class="modal fade" id="modalDeleteCohort" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <h5 class="text-danger">Are you sure you want to delete this Cohort?</h5>
                            </div>
                            <div class="modal-footer">
                                <form id="deleteCohortForm" action="" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success">Yes Delete</button>
                                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/create/class')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Create New Cohort</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".openModalDeleteCohort").click(function (event){
            event.preventDefault();
            let url = $(this).attr("data_url");
            $("#deleteCohortForm").attr("action",url);
            $("#modalDeleteCohort").modal('show');
        });
        $(document).ready( function () {
            $('#sessionClasses').DataTable();
        } );
    </script>
@endsection
