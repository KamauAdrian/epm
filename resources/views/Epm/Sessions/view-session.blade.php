@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')

{{--    @include('Epm.layouts.session-view')--}}
<div class="col-md-12">
    <?php
    $auth_admin = auth()->user();
    $session_date = date_create($trainingSession->start_date);
    $split_date = date_format($session_date,'l dS M Y');
    $days = $trainingSession->trainingDays;
//    dd($days);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h6><span class="text-small" style="font-size: 14px">Training</span></h6>
                            <p class="font-weight-normal">{{$trainingSession->name}}</p>
                        </div>
                        <div class="col-md-3">
                            <h6><span class="text-small" style="font-size: 14px">Status</span></h6>
                            @if($trainingSession->status == 'Approved')
                                <p style="font-size: 12px"><span class="badge badge-pill badge-light-dark">{{$trainingSession->status}}</span></p>
                            @elseif($trainingSession->status != 'Approved')
                                <div class="btn-group">
                                    <button type = "button" class = "btn btn-outline-info dropdown-toggle mb-2" data-toggle="dropdown">
                                        <span class="badge badge-pill badge-light-dark">{{$trainingSession->status}}</span>
                                        <span class = "caret"></span>
                                    </button>
                                    @if($auth_admin->role->name == 'Su Admin')
                                        <ul class = "dropdown-menu" role = "menu">
                                            <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$trainingSession->id)}}">Approve Session</a></li>
                                        </ul>
                                    @endif
                                </div>
                            @endif
{{--                            <p class="font-weight-normal">{{$trainingSession->status}}</p>--}}
                        </div>
                        <div class="col-md-3">
                            <h6><span class="text-small" style="font-size: 14px">Description</span></h6>
                            <p class="font-weight-normal">{{$trainingSession->about}}</p>
                        </div>
                        <div class="col-md-3">
                            <h6><span class="text-small" style="font-size: 14px">Scheduled Dates</span></h6>
                            <p class="font-weight-normal">Start: {{date('dS M Y',strtotime($trainingSession->start_date))}} <br /> End: {{date('dS M Y',strtotime($trainingSession->end_date))}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Trainings Per Day</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($days as $key=>$day)
                                <?php
                                $trainers = $day->trainers;
                                $classes = $day->classes;
                                $trainees = $day->trainees;
                                ?>
                                <a href="{{url("adm/".$auth_admin->id."/view/session/".$trainingSession->id."/training/day/".$day->id)}}">
                                    <div class="card" style="color: grey">
                                    <div class="card-header">
                                        {{date('dS M Y',strtotime($day->day))}}
                                    </div>
                                    <div class="card-body">
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
                                                    <h6 class="text-small" style="font-size: 14px">Trainees</h6>
                                                    @if($trainees)
                                                        {{count($trainees)}}
                                                    @else
                                                        No Trainees Yet
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#traineesList').DataTable();
    </script>
@endsection
