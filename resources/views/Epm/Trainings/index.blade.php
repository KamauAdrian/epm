@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    if ($trainings){
        $virtual_trainings = [];
        $physical_trainings = [];
        $tots = [];
        foreach ($trainings as $training){
            if ($training->training == "Virtual"){
            $virtual_trainings[] = $training;
            }
            if ($training->training == "Physical"){
                $physical_trainings[] = $training;
            }
            if ($training->training == "TOT"){
                $tots[] = $training;
            }
        }
//        dd($trainings,$virtual_trainings,$physical_trainings,$tot);
    }
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
            <div class="col-md-12 mt-2">
                @if($trainings)
                    <div class="tab-content p-0" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <ul class="nav nav-pills nav-fill mb-2" id="pills-tab" role="tablist">

                            @if($physical_trainings)
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-physical-tab" data-toggle="pill" href="#pills-physical" role="tab" aria-controls="pills-physical" aria-selected="true">
                                        <span>Physical Trainings</span>
                                    </a>
                                </li>
                            @endif
                            @if($virtual_trainings && !$physical_trainings)
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-virtual-tab" data-toggle="pill" href="#pills-virtual" role="tab" aria-controls="pills-virtual" aria-selected="false">
                                        <span>Virtual Trainings</span>
                                    </a>
                                </li>
                            @elseif($virtual_trainings)
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-virtual-tab" data-toggle="pill" href="#pills-virtual" role="tab" aria-controls="pills-virtual" aria-selected="false">
                                        <span>Virtual Trainings</span>
                                    </a>
                                </li>
                            @endif
                            @if($tots && !$physical_trainings && !$virtual_trainings)
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-tot-tab" data-toggle="pill" href="#pills-tot" role="tab" aria-controls="pills-tot" aria-selected="false">
                                        <span>TOT Trainings</span>
                                    </a>
                                </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" id="pills-tot-tab" data-toggle="pill" href="#pills-tot" role="tab" aria-controls="pills-tot" aria-selected="false">
                                    <span>TOT Trainings</span>
                                </a>
                            </li>
                            @endif
                            </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @if($physical_trainings)
                                <div class="tab-pane fade show active" id="pills-physical" role="tabpanel" aria-labelledby="pills-physical-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/physical/training/timetable')}}" class="float-right">
                                                <button type="button" class="btn btn-outline-info">Physical Training Timetable</button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableListDataTable" class="table table-center mb-0 ">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Training</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th class="text-right">Status</th>
                                                    </tr>
                                                    </thead>
                                                        <tbody>
                                                        @foreach($physical_trainings as $key=>$physical_training)
                                                            <tr>
                                                                <td>{{count($physical_trainings)-$key}}</td>
                                                                <td>
                                                                    <div class="media">
                                                                        <div class="media-body ml-3 align-self-center">
                                                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$physical_training->id)}}">
                                                                                <h5 class="mb-1">{{$physical_training->training}}</h5>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{date("dS M Y",strtotime($physical_training->start_date))}}
                                                                </td>
                                                                <td>
                                                                    {{date("dS M Y",strtotime($physical_training->end_date))}}
                                                                </td>

                                                                @if($physical_training->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="badge badge-pill badge-light-dark">{{$physical_training->status}}</span>
                                                                                <span class = "caret"></span>
                                                                            </button>
                                                                            <ul class = "dropdown-menu" role = "menu">
                                                                                <li><a href = "{{url('/view-session',$physical_training->id)}}">View Training</a></li>
                                                                                <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$physical_training->id)}}">Approve Training</a></li>
                                                                                <li><a href = "#!">Delete Training</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                @else
                                                                    <td class="text-right">
                                                                        <div class="btn-group">
                                                                            <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                                <span class="badge badge-pill badge-light-dark">{{$physical_training->status}}</span>
                                                                                <span class = "caret"></span>
                                                                            </button>
                                                                            <ul class = "dropdown-menu" role = "menu">
                                                                                <li><a href ="{{url('/adm/view/session',$physical_training->id)}}">View Training</a></li>
                                                                                <li><a href ="#!">Delete Training</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($virtual_trainings && !$physical_trainings)
                                <div class="tab-pane fade show active" id="pills-virtual" role="tabpanel" aria-labelledby="pills-virtual-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/virtual/training/timetable')}}" class="float-right">
                                                <button type="button" class="btn btn-outline-info">Virtual Training Timetable</button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableListDataTable1" class="table table-center mb-0 ">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Training</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th class="text-right">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($virtual_trainings as $key=>$virtual_training)
                                                        <tr>
                                                            <td>{{count($virtual_trainings)-$key}}</td>
                                                            <td>
                                                                <div class="media">
                                                                    <div class="media-body ml-3 align-self-center">
                                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$virtual_training->id)}}">
                                                                            <h5 class="mb-1">{{$virtual_training->training}}</h5>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($virtual_training->start_date))}}
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($virtual_training->end_date))}}
                                                            </td>

                                                            @if($virtual_training->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$virtual_training->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href = "{{url('/view-session',$virtual_training->id)}}">View Training</a></li>
                                                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$virtual_training->id)}}">Approve Training</a></li>
                                                                            <li><a href = "#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$virtual_training->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href ="{{url('/adm/view/session',$virtual_training->id)}}">View Training</a></li>
                                                                            <li><a href ="#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($virtual_trainings)
                                <div class="tab-pane fade show" id="pills-virtual" role="tabpanel" aria-labelledby="pills-virtual-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/virtual/training/timetable')}}" class="float-right">
                                                <button type="button" class="btn btn-outline-info">Virtual Training Timetable</button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableListDataTable1" class="table table-center mb-0 ">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Training</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th class="text-right">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($virtual_trainings as $key=>$virtual_training)
                                                        <tr>
                                                            <td>{{count($virtual_trainings)-$key}}</td>
                                                            <td>
                                                                <div class="media">
                                                                    <div class="media-body ml-3 align-self-center">
                                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$virtual_training->id)}}">
                                                                            <h5 class="mb-1">{{$virtual_training->training}}</h5>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($virtual_training->start_date))}}
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($virtual_training->end_date))}}
                                                            </td>

                                                            @if($virtual_training->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$virtual_training->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href = "{{url('/view-session',$virtual_training->id)}}">View Training</a></li>
                                                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$virtual_training->id)}}">Approve Training</a></li>
                                                                            <li><a href = "#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$virtual_training->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href ="{{url('/adm/view/session',$virtual_training->id)}}">View Training</a></li>
                                                                            <li><a href ="#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($tots && !$physical_trainings && !$virtual_trainings)
                                <div class="tab-pane fade show active" id="pills-tot" role="tabpanel" aria-labelledby="pills-tot-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/tot/training/timetable')}}" class="float-right">
                                                <button type="button" class="btn btn-outline-info">TOT Training Timetable</button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableListDataTable2" class="table table-center mb-0 ">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Training</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th class="text-right">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tots as $key=>$tot)
                                                        <tr>
                                                            <td>{{count($tots)-$key}}</td>
                                                            <td>
                                                                <div class="media">
                                                                    <div class="media-body ml-3 align-self-center">
                                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$tot->id)}}">
                                                                            <h5 class="mb-1">{{$tot->training}}</h5>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($tot->start_date))}}
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($tot->end_date))}}
                                                            </td>

                                                            @if($tot->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$tot->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href = "{{url('/view-session',$tot->id)}}">View Training</a></li>
                                                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$tot->id)}}">Approve Training</a></li>
                                                                            <li><a href = "#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$tot->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href ="{{url('/adm/view/session',$tot->id)}}">View Training</a></li>
                                                                            <li><a href ="#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($tots)
                                <div class="tab-pane fade show" id="pills-tot" role="tabpanel" aria-labelledby="pills-tot-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/view/tot/training/timetable')}}" class="float-right">
                                                <button type="button" class="btn btn-outline-info">TOT Training Timetable</button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tableListDataTable2" class="table table-center mb-0 ">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Training</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th class="text-right">Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tots as $key=>$tot)
                                                        <tr>
                                                            <td>{{count($tots)-$key}}</td>
                                                            <td>
                                                                <div class="media">
                                                                    <div class="media-body ml-3 align-self-center">
                                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/training',$tot->id)}}">
                                                                            <h5 class="mb-1">{{$tot->training}}</h5>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($tot->start_date))}}
                                                            </td>
                                                            <td>
                                                                {{date("dS M Y",strtotime($tot->end_date))}}
                                                            </td>

                                                            @if($tot->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$tot->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href = "{{url('/view-session',$tot->id)}}">View Training</a></li>
                                                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$tot->id)}}">Approve Training</a></li>
                                                                            <li><a href = "#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                                                            <span class="badge badge-pill badge-light-dark">{{$tot->status}}</span>
                                                                            <span class = "caret"></span>
                                                                        </button>
                                                                        <ul class = "dropdown-menu" role = "menu">
                                                                            <li><a href ="{{url('/adm/view/session',$tot->id)}}">View Training</a></li>
                                                                            <li><a href ="#!">Delete Training</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/new/training')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Training</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        $("#tableListDataTable1").dataTable({
            "order":[]
        });
        $("#tableListDataTable2").dataTable({
            "order":[]
        });
    </script>
@endsection
