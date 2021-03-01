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
        //    dd($days);
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Days</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($days as $key=>$day)
                                <?php
                                $trainers = $day->trainers;
                                $classes = $day->classes;
                                $trainees = $day->trainees;
                                ?>
                                <div class="card" style="color: grey">
                                    <div class="card-header mb-0">
                                        Day {{$key+1}}
                                        {{date('dS M Y',strtotime($day->day))}}
                                        <button type="button" class="btn float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-horizontal"></i>
                                        </button>
                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                            <a href="{{url('/adm/'.$auth_admin->id.'/edit/training/'.$training->id)}}"><li class="dropdown-item">Edit</li></a>
                                            <a href="#!"><li class="dropdown-item close-card">Delete</li></a>
                                        </ul>
                                    </div>
                                    <a href="{{url("adm/".$auth_admin->id."/view/training/".$training->id."/day/".$day->id."/".$key)}}">
                                        <div class="card-body mt-0">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h6 class="text-small" style="font-size: 14px">Trainers</h6>
                                                        @foreach($trainers as $trainer)
                                                            <?php
                                                            $split_name = explode(' ',$trainer->name);
                                                            $avatar_icon_name = '';
                                                            if (count($split_name)>1){
                                                                $avatar_icon_name = $split_name[0];
                                                            }else{
                                                                $avatar_icon_name = $trainer->name;
                                                            }
                                                            ?>
                                                            <span class="badge badge-pill badge-success p-2">{{$avatar_icon_name}}</span>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6 class="text-small" style="font-size: 14px">Classes/Cohorts</h6>
                                                        @foreach($classes as $class)
                                                            <?php
                                                            $split_name = explode(' ',$class->name);
                                                            $name = '';
                                                            if (count($split_name)>1){
                                                                $name = $split_name[0];
                                                            }else{
                                                                $name = $class->name;
                                                            }
                                                            ?>
                                                            <span class="badge badge-pill badge-success p-2">{{$name}}</span>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6 class="text-small" style="font-size: 14px">Trainees</h6>
                                                            </div>
                                                            @if($trainees)
                                                                <div class="col-md-12">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <td><span><i class="fa fa-male"></i> Male</span></td>
                                                                            <td>24</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><span><i class="fa fa-female"></i> Female</span></td>
                                                                            <td>24</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total</td>
                                                                            <td>42</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            @else
                                                                No Trainees Yet
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

