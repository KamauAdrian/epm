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
            <div class="col-sm-12">
                <h1 class="d-inline-block mb-0 font-weight-normal">Physical Training Daily Reports</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
                {{--            </div>--}}
                {{--            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">--}}
                <a href="{{url('/adm/'.$auth_admin->id.'/submit/daily/physical/training/report')}}" class="float-right">
                    {{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Submit Report</button>
                </a>
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
                            <table class="table table-center mb-0 ">
                                <thead>
                                <tr> <th>Report</th> <th class="text-right">Actions</th> </tr>
                                </thead>
                                @if($reports)
                                    <tbody>
                                    @foreach($reports as $report)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$report->name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/daily/physical/training/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View Report"><span><i class="fa fa-list"></i></span></a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Download Report"><span><i class="fa fa-download"></i></span></a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/daily/physical/training/report/report_id='.$report->id)}}" class="btn btn-sm btn-outline-info" title="View"><span><i class="fa fa-list"></i></span></a>
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
