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
                            <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/reports')}}">Daily Attendance Reports</a></li>
                            {{--                        <li class="breadcrumb-item"><a href="#!">Submit Daily Attendance Report</a></li>--}}
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
                            <h1 class="f-w-400">Daily Attendance Report</h1>
                        </div>
                        <form action="#!">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{$report->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="email" class="form-control" placeholder="Luke S" value="{{$report->email}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{$report->phone}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" name="email" class="form-control" placeholder="Luke S" value="{{$report->date}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Training Job Category</label>
                                        <input type="text" class="form-control" value="{{$report->speciality}}" disabled>
                                    </div>
                                </div>
                                <?php
                                $roles = \Illuminate\Support\Facades\DB::table('trainer_training_task_roles')->where('daily_attendance_report_id',$report->id)->get();
                                $all = array();
                                foreach ($roles as $role){
                                    $all[] = $role->name;
                                }
                                $array_string = implode(", ",$all);
                                ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Your Role/Task of The Day</label>
                                            <input type="text" class="form-control"
                                            value="{{$array_string}}" disabled>
                                    </div>
                                </div>
                                @if($report->other_training_task_roles!=null)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Other Roles</label>
                                            <input type="text" class="form-control"
                                                   value="{{$report->other_training_task_roles}}" disabled>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>The Time You were Training</label>
                                        <input type="time" name="time" class="form-control" value="{{$report->time}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <input type="text" name="comments" class="form-control"  value="{{$report->comments}}" disabled>
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
