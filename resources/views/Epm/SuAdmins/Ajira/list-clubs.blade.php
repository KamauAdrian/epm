@extends('Epm.SuAdmins.layouts.list')
{{--@inject('teamCM', 'App\Models\TeamCenterManager')--}}
@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('page-title','Ajira Clubs')

@section('button-text',' New Ajira Club')

@section('add-url','add-ajira-club')

@section('content-list')
    @include('Epm.layouts.ajira-clubs')
@endsection



