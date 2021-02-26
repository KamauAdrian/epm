@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>

    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="d-inline-block mb-0 font-weight-normal">Daily Attendance Reports</h1>
                @if($auth_admin->role->name == 'Trainer')
                    <a href="{{url('/adm/'.$auth_admin->id.'/submit/daily/attendance/report')}}" class="float-right">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Submit Attendance</button>
                    </a>
                @endif
            </div>
            <div class="col-sm-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportsTableList" class="table table-center mb-0 ">
                                <thead>
                                <tr> <th>Reports</th> <th>Date</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                                @if($reports)
                                    <tbody>
                                    @foreach($reports as $report)
                                        <?php
                                        $format_date = date('l dS M Y',strtotime($report->created_at));
                                        $trainer = $report->owner;
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$trainer->name}}</h5>
                                                        <p class="mb-0">{{$trainer->email}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$format_date}}</td>
                                            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View Report"><span><i class="fa fa-list"></i></span></a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View"><span><i class="fa fa-list"></i></span></a>
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
            $('#reportsTableList').DataTable();
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
