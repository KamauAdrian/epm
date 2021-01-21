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
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/reports')}}">Daily Reports</a></li>
{{--                        <li class="breadcrumb-item"><a href="#!">Submit Daily Report</a></li>--}}
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
                            <h1 class="f-w-400">Physical Training Daily Report</h1>
                        </div>
                        {{--                            @include('Epm.layouts.trainer-add')--}}
                        <form action="{{url('/adm/'.$auth_admin.'/save/daily/attendance/report')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>This report helps in understanding how you conduct your day to day training, including any achievements or challenges you have encountered.</p>
                                        <p> The report should be submitted everyday at the end of the training session. In case of any challenges contact the Ajira Program Management Team for support.</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Names of Trainer</label>
                                        <input type="text" name="name" class="form-control" value="{{$trainer->name}}" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What County is Training being conducted</label>
                                        <input type="text" name="county" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What Constituency is training being conducted?</label>
                                        <input type="text" name="constituency" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('constituency')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What is the Name of Youth Center/ TVET / University?</label>
                                        <input type="text" name="center" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('center')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended the training?</label>
                                        <input type="text" name="total_trainees" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('total_trainees')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were women? </label>
                                        <input type="text" name="total_trainees_female" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('total_trainees_female')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were men?</label>
                                        <input type="text" name="total_trainees_men" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('total_trainees_men')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What achievements and challenges did you encounter as a trainer?</label>
                                        <input type="text" name="trainer_challenges_achievements" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('trainer_challenges_achievements')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What would you recommend to make the training better?</label>
                                        <input type="text" name="training_recommendation" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('training_recommendation')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What support do you need to perform your role better?</label>
                                        <input type="text" name="training_support" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('training_support')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload a Photo of the training</label>
                                        <input type="file" name="training_photo" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('training_photo')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What will you be training the next day?</label>
                                        <input type="text" name="next_training" class="form-control" placeholder="Your Answer">
                                        <span class="text-danger">{{$errors->first('next_training')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="btn_submit">
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
