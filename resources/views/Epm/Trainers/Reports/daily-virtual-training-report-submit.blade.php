@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
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
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Ajira Digital Virtual Training Report</h1>
                        </div>
                        {{--                            @include('Epm.layouts.trainer-add')--}}
                        <form action="{{url('/adm/'.$auth_admin->id.'/save/daily/virtual/training/report')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>This report helps in understanding how you conduct your day to day training, including any achievements or challenges you have encountered.</p>
                                        <p>The report should be submitted everyday at the end of the training session. In case of any challenges contact the Ajira Program Management Team for support.</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="text-danger">{{$errors->first('training_category')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Online Work Category trained </label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Data Management"
                                                   id="checkCategory1" name="training_category">
                                            <label for="checkCategory1" class="form-check-label">Data Management</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Digital Marketing"
                                                   id="checkCategory2" name="training_category">
                                            <label for="checkCategory2" class="form-check-label">Digital Marketing</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Transcription"
                                                   id="checkCategory3" name="training_category">
                                            <label for="checkCategory3" class="form-check-label">Transcription</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Content Writing"
                                                   id="checkCategory4" name="training_category">
                                            <label for="checkCategory4" class="form-check-label">Content Writing</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Virtual Assistant"
                                                   id="checkCategory5" name="training_category">
                                            <label for="checkCategory5" class="form-check-label">Virtual Assistant</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full name of Trainers who trained</label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended morning session?</label>
                                        <input type="text" value="{{old('total_trainees_morning_session')}}" name="total_trainees_morning_session" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_morning_session')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended the afternoon session?</label>
                                        <input type="text" value="{{old('total_trainees_afternoon_session')}}" name="total_trainees_afternoon_session" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_afternoon_session')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended all sessions?</label>
                                        <input type="text" value="{{old('total_trainees_all_sessions')}}" name="total_trainees_all_sessions" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_all_sessions')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees were female?</label>
                                        <input type="text" value="{{old('total_trainees_female')}}" name="total_trainees_female" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_female')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees were male?</label>
                                        <input type="text" value="{{old('total_trainees_male')}}" name="total_trainees_male" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_male')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What facilitation techniques were used during the training?</label>
                                        <input type="text" value="{{old('training_facilitation_techniques')}}" name="training_facilitation_techniques" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_facilitation_techniques')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What challenges did you face during the training and how did you go about it?</label>
                                        <input type="text" value="{{old('training_challenges')}}" name="training_challenges" class="form-control" placeholder="Your Answer"required>
                                        <span class="text-danger">{{$errors->first('training_challenges')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What would you recommend to improve the training?</label>
                                        <input type="text" value="{{old('training_recommendation')}}" name="training_recommendation" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_recommendation')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainers were available during the training? Name any trainer who was missing and why? </label>
                                        <input type="text" value="{{old('training_trainers_available_missing')}}" name="training_trainers_available_missing" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_trainers_available_missing')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Attach a screenshot of all the trainees that attend the training.</label>
                                        <input type="file" name="trainees_photo" class="form-control">
                                        <span class="text-danger">{{$errors->first('trainees_photo')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right mt-2">
                                        <button type="submit" class="btn btn-outline-primary btn-block mb-3">Submit</button>
                                    </div>
                                </div>
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
