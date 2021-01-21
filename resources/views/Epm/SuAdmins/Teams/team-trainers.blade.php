@extends('Epm.SuAdmins.layouts.list')
@inject('teamTrainers', 'App\Models\TeamTrainer')
@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Team Trainers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                <a href="{{url('/add-team-trainers')}}">
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Team Trainers</button>
                </a>

                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('Epm.layouts.team-trainers-list')
                <a href="{{url('/add-team-trainers')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Team Trainers</a>
            </div>
        </div>
    </div>
@endsection


