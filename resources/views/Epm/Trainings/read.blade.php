@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

    {{--    @include('Epm.layouts.session-view')--}}
    <div class="col-md-12">
        <?php
        $auth_admin = auth()->user();
        $session_date = date_create($training->start_date);
        $split_date = date_format($session_date,'l dS M Y');
        $days = $training->trainingDays;
        $center = $training->center;
        $trainers_raw = $training->trainers;
        $trainers = [];
        foreach ($trainers_raw as $trainer_raw){
            $trainers[] = $trainer_raw->name;
        }
        $classes_raw = $training->classes;
        $classes = [];
        foreach ($classes_raw as $class_raw){
            $classes[] = $class_raw->name;
        }
        $centers_raw = $training->centers;
        $centers = [];
        foreach ($centers_raw as $center_raw){
            $centers[] = $center_raw->name;
        }
//        dd($trainers_raw);
//        dd($training->start_date,$training->end_date);

        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Training</span></h6>
                                <p class="font-weight-normal">{{$training->training}}</p>
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Status</span></h6>
                                @if($training->status == 'Approved')
                                    <p style="font-size: 12px"><span class="badge badge-pill badge-light-dark">{{$training->status}}</span></p>
                                @elseif($training->status != 'Approved')
                                    <div class="btn-group">
                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle mb-2" data-toggle="dropdown">
                                            <span class="badge badge-pill badge-light-dark">{{$training->status}}</span>
                                            <span class = "caret"></span>
                                        </button>
                                        @if($auth_admin->role->name == 'Su Admin')
                                            <ul class = "dropdown-menu" role = "menu">
                                                <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/training/'.$training->id)}}">Approve Training</a></li>
                                            </ul>
                                        @endif
                                    </div>
                                @endif
                                {{--                            <p class="font-weight-normal">{{$trainingSession->status}}</p>--}}
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Description</span></h6>
                                <p class="font-weight-normal">{{$training->description}}</p>
                            </div>
                            <div class="col-md-3">
                                <h6><span class="text-small" style="font-size: 14px">Scheduled Dates</span></h6>
                                <p class="font-weight-normal">Start: {{date('dS M Y',strtotime($training->start_date))}} <br /> End: {{date('dS M Y',strtotime($training->end_date))}}</p>
                            </div>
                            @if($training->training == "Physical" || $training->training == "TOT")
                                <div class="col-md-4">
                                    @if($trainers)
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        @foreach($trainers as $trainer)
                                            {{$trainer}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Choose Training Center" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if($centers)
                                        <h6><span class="text-small" style="font-size: 14px">Centers</span></h6>
                                        @foreach($centers as $center)
                                            {{$center}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Centers</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Choose Training Center" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    @if($classes)
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        @foreach($classes as $class)
                                            {{$class}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Add Classes To Training" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            @endif
                            @if($training->training == "Virtual")
                                <div class="col-md-6">
                                    @if($trainers)
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        @foreach($trainers as $trainer)
                                            {{$trainer}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Trainers</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Choose Training Center" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if($classes)
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        @foreach($classes as $class)
                                            {{$class}}<br />
                                        @endforeach
                                    @else
                                        <h6><span class="text-small" style="font-size: 14px">Classes</span></h6>
                                        <a href="#!">
                                            <button type="button" title="Add Classes To Training" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                @if($training->training == "Physical")
                    @include("Epm.Trainings.Physical.index")
                @endif
                @if($training->training == "Virtual")
                    @include("Epm.Trainings.Virtual.index")
                @endif
                @if($training->training == "TOT")
                    @include("Epm.Trainings.TOT.index")
                @endif
            </div>
        </div>
    </div>
@endsection

