@extends('Epm.SuAdmins.layouts.list')
@inject('teamCM', 'App\Models\TeamCenterManager')

@section('content')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Team Center Managers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                <a href="{{url('/adm/add/team/cms')}}">
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Team Center Managers</button>
                </a>

                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('Epm.layouts.team-cms-list')
                <a href="{{url('/adm/add/team/cms')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add @yield('button-text')</a>
            </div>
        </div>
    </div>
@endsection



