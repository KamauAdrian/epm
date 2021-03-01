@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Trainings</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/new/training')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Training</button>
                    </a>
                @endif
{{--                <a href="#!">--}}
{{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
{{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

                <?php
                $auth_admin = auth()->user();
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sessionsTable" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Training</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th class="text-right">Status</th>
                                </tr>
                                </thead>
                                @if($trainings!='')
                                    <tbody>
                                    @foreach($trainings as $key=>$training)
                                        <tr>
                                            <td>{{count($trainings)-$key}}</td>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$training->id)}}">
                                                            <h5 class="mb-1">{{$training->training}}</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{$training->start_date}}
                                            </td>
                                            <td>
                                                {{$training->end_date}}
                                            </td>

                                            @if($training->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="badge badge-pill badge-light-dark">{{$training->status}}</span>
                                                            <span class = "caret"></span>
                                                        </button>
                                                        <ul class = "dropdown-menu" role = "menu">
                                                            <li><a href = "{{url('/view-session',$training->id)}}">View Training</a></li>
                                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$training->id)}}">Approve Training</a></li>
                                                            <li><a href = "#!">Delete Training</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                            <span class="badge badge-pill badge-light-dark">{{$training->status}}</span>
                                                            <span class = "caret"></span>
                                                        </button>
                                                        <ul class = "dropdown-menu" role = "menu">
                                                            <li><a href ="{{url('/adm/view/session',$training->id)}}">View Training</a></li>
                                                            <li><a href ="#!">Delete Training</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>



            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/new/training')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Training</a>
                @endif
            </div>
        </div>
    </div>
@endsection
