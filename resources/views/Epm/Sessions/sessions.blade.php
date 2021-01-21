@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Sessions</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/session')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Session</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('Epm.layouts.sessions-list')
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/session')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Session</a>
                @endif
            </div>
        </div>
    </div>

@endsection
