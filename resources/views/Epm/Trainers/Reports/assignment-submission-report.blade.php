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
                            <h1 class="f-w-400">Ajira Digital Curriculum Trainers-Assignment Submission Report</h1>
                        </div>
                        {{--                            @include('Epm.layouts.trainer-add')--}}
                        <form action="{{url('/adm/'.$auth_admin->id.'/save/assignment/report')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Name (In the order of First Name, Middle Name, Surname) </label>
                                        <input type="text" disabled name="name" class="form-control" placeholder="Luke S" value="{{$report->name}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Employee Number</label>
                                        <input type="text" disabled name="employee_number" class="form-control" placeholder="00198" value="{{$report->employee_number}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Training Job Category</label>
                                        <input type="text" disabled name="employee_number" class="form-control" placeholder="00198" value="{{$report->speciality}}">
                                    </div>
                                </div>
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Kindly Upload your complete assignment as a Word Document</label>--}}
{{--                                        <input type="file" name="assignment" class="form-control" placeholder="Upload assignment">--}}
{{--                                        <span class="text-danger">{{$errors->first('assignment')}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
