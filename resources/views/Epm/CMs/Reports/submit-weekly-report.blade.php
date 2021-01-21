@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
{{--            <div class="auth-wrapper align-items-stretch bg-white">--}}
{{--                <div class="auth-side-form">--}}
{{--                    <div class="auth-content">--}}
            <div class="col-md-12" style="padding-left: 100px; padding-right: 100px">
                <div class="text-center">
                    <h1 class="f-w-400">Weekly Reporting</h1>
                </div>
                @include('Epm.layouts.Reports.submit-weekly-report')
            </div>
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
