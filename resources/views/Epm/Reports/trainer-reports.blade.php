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
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Trainer Reports</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Daily Attendance Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-6">
                                {{--                                    <a href="#!">--}}
                                <a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/daily/attendance/reports')}}">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#!">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Daily Training Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-6">
                                {{--                                    <a href="#!">--}}
                                <a href="{{url('/adm/'.$auth_admin->id.'/view/daily/training/reports')}}">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#!">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Assignment Submission Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-6">
                                {{--                                    <a href="#!">--}}
                                <a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/assignment/submission/reports')}}">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#!">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Competence Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-6">
                                {{--                                    <a href="#!">--}}
                                <a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/competence/reports')}}">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#!">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Leave Application Reports</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" >
                            <div class="col-md-6">
                                {{--                                    <a href="#!">--}}
                                <a href="{{url('/adm/'.$auth_admin->id.'/view/leave/applications')}}">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Reports</p></button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#!">
                                    <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">Download <br> Reports</p></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
