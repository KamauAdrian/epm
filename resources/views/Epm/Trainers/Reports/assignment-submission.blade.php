@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Ajira Digital Curriculum Trainers-Assignment Submission</h1>
                        </div>
                        {{--                            @include('Epm.layouts.trainer-add')--}}
                        <form action="{{url('/adm/'.$auth_admin->id.'/save/assignment/report')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>Please complete the form by attaching your Assignment. Use the template that we sent you.</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Name (In the order of First Name, Middle Name, Surname) </label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{$trainer->name}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Employee Number</label>
                                        <input type="text" name="employee_number" class="form-control" placeholder="00198" value="{{$trainer->employee_number}}">
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
                                        <label>Kindly Upload your complete assignment as a Word Document</label>
                                        <input type="file" name="assignment" class="form-control" placeholder="Upload assignment">
                                        <span class="text-danger">{{$errors->first('assignment')}}</span>
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
