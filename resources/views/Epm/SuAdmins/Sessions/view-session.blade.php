@extends('Epm.layouts.master')

@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('content')
        @include('Epm.layouts.session-view')
@endsection
