@extends('Epm.Admins.Trainers.layouts.master')
{{--@section('title','layouts')--}}
@section('content')
    <div class="auth-wrapper align-items-stretch bg-white">
        <div class="auth-side-form">
            <div class="auth-content">
                <div class="text-center">
                    <h1 class="f-w-400">@yield('form-desc')</h1>
                </div>
                @yield('form')
            </div>
            <div class="footer-cont text-center">
                <h6 class="mb-0 text-muted">©2020 All Rights Reserved. Treva®</h6>
            </div>
        </div>
    </div>
@endsection
