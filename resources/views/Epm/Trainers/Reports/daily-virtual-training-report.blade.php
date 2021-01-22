@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    @if($auth_admin->role->name =='Trainer')
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/virtual/training/reports')}}">Virtual Training Reports</a></li>
                            {{--                        <li class="breadcrumb-item"><a href="#!">Submit Virtual Training Report</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Ajira Digital Virtual Training Report</h1>
                        </div>
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Online Work Category trained </label>
                                            <input type="text" class="form-control" value="{{$report->training_category}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full name of Trainers who trained</label>
                                        <input type="text" value="{{$report->trainer_name}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended morning session?</label>
                                        <input type="text" class="form-control" value="{{$report->total_trainees_morning_session}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended the afternoon session?</label>
                                        <input type="text" class="form-control" value="{{$report->total_trainees_afternoon_session}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended all sessions?</label>
                                        <input type="text" class="form-control" value="{{$report->total_trainees_all_sessions}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees were female?</label>
                                        <input type="text" class="form-control" value="{{$report->total_trainees_female}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees were male?</label>
                                        <input type="text" class="form-control" value="{{$report->total_trainees_male}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What facilitation techniques were used during the training?</label>
                                        <input type="text" class="form-control" value="{{$report->training_facilitation_techniques}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What challenges did you face during the training and how did you go about it?</label>
                                        <input type="text" class="form-control" value="{{$report->training_challenges}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What would you recommend to improve the training?</label>
                                        <input type="text" class="form-control" value="{{$report->training_recommendation}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainers were available during the training? Name any trainer who was missing and why? </label>
                                        <input type="text" class="form-control" value="{{$report->training_trainers_available_missing}}" disabled>
                                    </div>
                                </div>
                                @if($report->trainees_photo)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Screenshot of all the trainees that attend the training.</label>
                                            <div>
                                                <img src="{{url('/VirtualTrainings/images',$report->trainees_photo)}}" alt="{{$report->trainees_photo}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function showInputOther(){
            var other = document.getElementById('checkRole6');
            var spother = document.getElementById('otherSpecify');
            if (other.checked==true){
                spother.style.display='block';
            }else {
                spother.style.display='none';
            }
        }
    </script>
@endsection
