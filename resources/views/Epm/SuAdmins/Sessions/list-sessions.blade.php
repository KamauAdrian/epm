@extends('Epm.SuAdmins.layouts.list')

@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('page-title','Sessions')

@section('button-text','Session')

@section('add-url','add-session')

@section('content-list')
    @include('Epm.layouts.sessions-list')
@endsection
