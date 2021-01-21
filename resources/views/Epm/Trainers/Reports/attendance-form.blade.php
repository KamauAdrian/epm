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
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/reports')}}">Daily Attendance Reports</a></li>
                        <li class="breadcrumb-item"><a href="#!">Submit Daily Attendance Report</a></li>
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
                                <h1 class="f-w-400">Attendance Form</h1>
                            </div>
{{--                            @include('Epm.layouts.trainer-add')--}}
                            <form action="{{url('/adm/'.$auth_admin->id.'/save/daily/attendance/report')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p>This form should be completed daily, this is to help track your activities and tasks during the day.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" name="emial" class="form-control" placeholder="Luke S" value="{{$trainer->email}}">
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{$trainer->name}}">
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Training Job Category</label>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="Data Management"
                                                       id="checkCategory1" name="job_category"
                                                       <?php if ($trainer->speciality=='Data Management'){?>
                                                       checked="checked"<?php } ?>>
                                                <label for="checkCategory1" class="form-check-label">Data Management</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="Digital Marketing"
                                                       id="checkCategory2" name="job_category"
                                                       <?php if ($trainer->speciality=='Digital Marketing'){?>
                                                       checked="checked"<?php } ?>>
                                                <label for="checkCategory2" class="form-check-label">Digital Marketing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="Transcription"
                                                       id="checkCategory3" name="job_category"
                                                       <?php if ($trainer->speciality=='Transcription'){?>
                                                       checked="checked"<?php } ?>>
                                                <label for="checkCategory3" class="form-check-label">Transcription</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="Content Writing"
                                                       id="checkCategory4" name="job_category"
                                                       <?php if ($trainer->speciality=='Content Writing'){?>
                                                       checked="checked"<?php } ?>>
                                                <label for="checkCategory4" class="form-check-label">Content Writing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" value="Virtual Assistant"
                                                       id="checkCategory5" name="job_category"
                                                       <?php if ($trainer->speciality=='Virtual Assistant'){?>
                                                       checked="checked"<?php } ?>>
                                                <label for="checkCategory5" class="form-check-label">Virtual Assistant</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Your Role/Task of The Day</label>
                                            <div class="form-check">
                                                <input type="checkbox" value="Moderator" class="form-check-input" id="checkRole1" name="job_task_role">
                                                <label for="checkRole1" class="form-check-label">Moderator</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" value="Trainer" class="form-check-input" id="checkRole2" name="job_task_role">
                                                <label for="checkRole2" class="form-check-label">Trainer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" value="Chat Manager" class="form-check-input" id="checkRole3" name="job_task_role">
                                                <label for="checkRole3" class="form-check-label">Chat Manager</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" value="Attendance Report" class="form-check-input" id="checkRole4" name="job_task_role">
                                                <label for="checkRole4" class="form-check-label">Attendance Report</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" value="Admitting Trainees in Class" class="form-check-input" id="checkRole5" name="job_task_role">
                                                <label for="checkRole5" class="form-check-label">Admitting Trainees in Class</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" value="Other" onclick="showInputOther()" class="form-check-input" id="checkRole6" name="job_task_role">
                                                <label for="checkRole6" class="form-check-label">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('job_task_role')}}</span>
                                    <div class="col-md-12" id="otherSpecify" style="display: none;">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="text" class="form-control" name="other_job_task_role" placeholder="Please specify what was your other role/task">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>The Time You were Training</label>
                                            <input type="time" name="training_time" class="form-control" value="{{old('training_time')}}">
                                            <span class="text-danger">{{$errors->first('training_time')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <input type="text" name="comments" class="form-control" placeholder="(If you trained 2 sessions please state the sessions and time) " value="{{old('comments')}}">
                                            <span class="text-danger">{{$errors->first('comments')}}</span>
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
