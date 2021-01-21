@extends('Epm.layouts.master')
@inject('teamCM', 'App\Models\TeamCenterManager')

@section('content')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Team Center Managers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if(auth()->user()->role->name == 'Su Admin' || auth()->user()->role->name == 'Project Manager')
                    <a href="{{url('/adm/add/team/cms')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Team Center Managers</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('Epm.layouts.team-cms-list')
                @if(auth()->user()->role->name == 'Su Admin' || auth()->user()->role->name == 'Project Manager')
                    <a href="{{url('/adm/add/team/cms')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Team Center Managers</a>
                @endif
            </div>
        </div>
    </div>
@endsection



