@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    @inject('user','App\Models\User')
    <?php
    $auth_admin = auth()->user();
    $group = explode(' ',$key_name);
    $week = $group[0].' '.$group[1].' Week '.$group[2];
    ?>
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    @if($role->name == 'Project Manager')
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/target_group_id='.$role->id)}}">Reports</a></li>
                            <li class="breadcrumb-item"><a href="#!">{{$template->name}}</a></li>
                        </ul>
                    @elseif($role->name == 'Center Manager')
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/target_group_id='.$role->id)}}">Reports</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_target_group_id='.$role->id)}}">{{$template->name}}</a></li>
                            <li class="breadcrumb-item"><a href="#!">{{$week}}</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal text-center">{{$week}}</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            {{--        <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">--}}
            {{--                <a href="#!">--}}
            {{--                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add PMO</button>--}}
            {{--                </a>--}}
            {{--            <a href="#!">--}}
            {{--                <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
            {{--            </a>--}}
            {{--        </div>--}}
        </div>
        <div class="row">
            <div class="col-sm-12">
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportsList" class="table table-center mb-0">
                                <thead>
                                <tr> <th>Reports</th> <th>Date</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                                @if($reports)
                                    <tbody>
                                    @foreach($reports as $report)
                                        <?php
                                                                            $format_date = date('l dS M Y',strtotime($report->date_of_report));
                                                                            $report_admin = \App\Models\User::find($report->user_id);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$report->name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$format_date}}</td>
                                            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/target_group_id='.$role->id.'/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View Report">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        {{--                                                    <a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$template->id.'/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View"><span><i class="fa fa-list"></i></span></a>--}}
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <h5 class="text-danger">Are you sure you want to delete this Admin?</h5>
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
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#reportsList').DataTable();
    </script>
@endsection
