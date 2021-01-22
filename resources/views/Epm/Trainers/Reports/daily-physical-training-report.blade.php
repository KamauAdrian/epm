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
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/physical/training/reports')}}">Daily Physical Training Reports</a></li>
                            {{--                        <li class="breadcrumb-item"><a href="#!">Submit Daily Report</a></li>--}}
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
                            <h1 class="f-w-400">Physical Training Daily Report</h1>
                        </div>
                        <form>
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Names of Trainer</label>
                                        <input type="text" class="form-control" value="{{$report->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What County is Training being conducted</label>
                                        <input type="text" class="form-control" value="{{$report->county}}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What Constituency is training being conducted?</label>
                                        <input type="text" class="form-control" value="{{$report->constituency}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What is the Name of Youth Center/ TVET / University?</label>
                                        <input type="text" class="form-control" value="{{$report->center}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended the training?</label>
                                        <input type="text" value="{{$report->total_trainees}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were women? </label>
                                        <input type="text" value="{{$report->total_trainees_female}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were men?</label>
                                        <input type="text" value="{{$report->total_trainees_male}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What achievements and challenges did you encounter as a trainer?</label>
                                        <input type="text" value="{{$report->trainer_challenges_achievements}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What would you recommend to make the training better?</label>
                                        <input type="text" value="{{$report->training_recommendation}}" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What support do you need to perform your role better?</label>
                                        <input type="text" value="{{$report->training_support}}" class="form-control" disabled>
                                    </div>
                                </div>
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Upload a Photo of the training</label>--}}
{{--                                        <input type="file" name="training_photo" class="form-control" placeholder="Your Answer">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What will you be training the next day?</label>
                                        <input type="text" value="{{$report->next_training}}" class="form-control" disabled>
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
