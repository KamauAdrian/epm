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

            </div>
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
                                        $format_date = date('l dS M Y',strtotime($report->date));
//                                        dd($report);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$report->name}}</h5>
                                                        <p class="mb-0">{{$report->email}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$format_date}}</td>
                                            <td>{{$report->speciality}}</td>
                                            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View Report"><span><i class="fas fa-eye"></i></span></a>
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
