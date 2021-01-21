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
                <a href="{{url('/adm/'.$auth_admin->id.'/submit/daily/report')}}" class="float-right">
                    {{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Submit Report</button>
                </a>
            </div>
        </div>
        {{--        @if($reports)--}}
        {{--            <div class="row">--}}
        {{--                @foreach($reports as $report)--}}
        {{--                    <div class="col-md-6">--}}
        {{--                        <div class="card">--}}
        {{--                            <div class="card-header">--}}
        {{--                                <h6>temp one</h6>--}}
        {{--                            </div>--}}
        {{--                            <div class="card-body">--}}
        {{--                                <div class="row" >--}}
        {{--                                    <div class="col-md-6">--}}
        {{--                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/report/template/')}}">--}}
        {{--                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Template</p></button>--}}
        {{--                                        </a>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-md-6">--}}
        {{--                                        <a href="#!">--}}
        {{--                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px;width: 150px;"><p class="align-self-center">Download <br>Template</p></button>--}}
        {{--                                        </a>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                @endforeach--}}
        {{--            </div>--}}
        {{--        @endif--}}
    </div>
@endsection
