@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    @inject('user','App\Models\User')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Competencies Reports</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                <a href="{{url('/adm/'.$auth_admin->id.'/asses/trainer/competence')}}">
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Assess Trainer</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="competenceTableList" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Reports</th>
                                    <th>Date</th>
                                    <th>Evaluator</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                @if($reports!='')
                                    <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$report->trainer_name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php $format_date = date('l dS M Y',strtotime($report->evaluation_date)); ?>
                                                {{$format_date}}
                                            </td>

                                            <td>
                                                {{$report->evaluator_name}}
                                            </td>
                                            @if($auth_admin->role->name != 'Su Admin')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/competence/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                            {{--                                                        <a href="{{url('/adm/view/adm/'.$auth_admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="View">--}}
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/competence/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Edit">
                                                            {{--                                                        <a href="{{url('/adm/edit/adm/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-info" title="Edit">--}}
                                                            <span><i class="fa fa-pencil-alt"></i></span></a>
                                                        <a href="#!" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal" data-target="#deleteAdmin" title="Delete">
                                                            {{--                                                        <a href="#!" data-url="{{url('/delete/admin/'.$admin->id.'/profile/role_id='.$role->id)}}" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal" data-target="#deleteAdmin" title="Delete">--}}
                                                            <span><i class="fa fa-trash"></i></span>
                                                        </a>
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
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#competenceTableList').DataTable();
        } );
    </script>
    <script type="text/javascript">
        $(function () {
            $(".deleteAdmin").click(function () {
                var url = $(this).attr('data-url');
                console.log('this is the url'+ url);
                $("#deleteAdminForm").attr("action", url);
            })
        });
    </script>
@endsection
