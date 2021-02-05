@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
        @include('Epm.layouts.Reports.templates')
{{--    <div class="col-md-12">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-6 d-flex align-items-center mb-4">--}}
{{--                <h1 class="d-inline-block mb-0 font-weight-normal">Reports Templates</h1>--}}
{{--                --}}{{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
{{--            </div>--}}
{{--            --}}{{--<div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">--}}
{{--                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/report/template')}}">--}}
{{--                    --}}{{----}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}{{----}}{{----}}
{{--                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <center>--}}
{{--                    @if(session()->has('success'))--}}
{{--                        <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                            <span class="text-success"><h5>{{session()->get('success')}}</h5></span>--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @elseif(session()->has('error'))--}}
{{--                        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                            <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </center>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table" id="reportTemplates">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Reporting Group</th>--}}
{{--                            <th>Create New Templates</th>--}}
{{--                            <th class="text-right">Templates</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <td>PMO</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/pmo/report/template/')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="text-right">--}}
{{--                                <a class="float-right" href="#!">--}}
{{--                                    --}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-list mr-2"></i> View Templates</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Center Managers</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/cm/report/template')}}">--}}
{{--                                    --}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="text-right">--}}
{{--                                <a class="float-right" href="#!">--}}
{{--                                    --}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-list mr-2"></i> View Templates</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>Trainers</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/trainer/report/template')}}">--}}
{{--                                    --}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td class="text-right">--}}
{{--                                <a class="float-right" href="#!">--}}
{{--                                    --}}{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
{{--                                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-list mr-2"></i> View Templates</button>--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
