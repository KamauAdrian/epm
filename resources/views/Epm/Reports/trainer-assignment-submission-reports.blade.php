@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12 mb-2">
                <h1 class="d-inline-block mb-0 font-weight-normal">Assignment Submission Reports</h1>
                @if($auth_admin->role->name == 'Trainer')
                    <a href="{{url('/adm/'.$auth_admin->id.'/submit/assignment/report')}}" class="float-right">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Submit Assignment</button>
                    </a>
                @endif
            </div>
            <div class="col-sm-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="reportsTableList" class="table table-center mb-0 ">
                                <thead>
                                    <tr> <th>Reports</th> <th>Date</th> <th>Training Job Category</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                                @if($reports)
                                    <tbody>
                                    @foreach($reports as $report)
                                        <?php
                                        $format_date = date('l dS M Y',strtotime($report->created_at));
                                        $trainer = $report->owner;
//                                        dd($report);
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
                                            <td>{{$trainer->speciality}}</td>
                                            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url("$report->assignment_link")}}" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
                                                        <a href="#!" class="btn btn-sm btn-outline-danger" title="Delete Report"><span><i class="fa fa-trash"></i></span></a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url("$report->assignment_link")}}" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
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
    {{--    @include('Epm.layouts.Reports.templates')--}}
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#reportsTableList').DataTable();
        } );
    </script>
@endsection
