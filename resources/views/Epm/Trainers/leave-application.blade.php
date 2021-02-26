@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    $applicant = $application->owner;
    $types = $application->types;
    $names = [];
    foreach ($types as $type){
        $names [] = $type->name;
    }
    $array_string = implode(", ",$names);
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Employee Leave Application</h1>
            </div>
            @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")
                <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    @if($application->status==0)
                        <a href="{{url('/adm/'.$auth_admin->id.'/reject/employee/leave/'.$application->id)}}">
                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Reject Leave</button>
                        </a>
                        <a href="{{url('/adm/'.$auth_admin->id.'/accept/employee/leave/'.$application->id)}}">
                            <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Accept Leave</button>
                        </a>
                    @elseif($application->status==1)
                        <button type="button" class="mr-2 btn d-block ml-auto btn-success" disabled>Leave Accepted</button>
                    @else
                        <button type="button" class="mr-2 btn d-block ml-auto btn-success" disabled>Leave Rejected</button>
                    @endif
                </div>
            @endif
            @if($auth_admin->role->name == "Trainer")
                <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                    @if($application->status==0)
                        <button type="button" class="mr-2 btn d-block ml-auto btn-success" disabled>Pending</button>
                    @elseif($application->status==1)
                        <button type="button" class="mr-2 btn d-block ml-auto btn-success" disabled>Leave Accepted</button>
                    @else
                        <button type="button" class="mr-2 btn d-block ml-auto btn-success" disabled>Leave Rejected</button>
                    @endif
                </div>
            @endif
        </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="#!">
                                    @csrf
                                    <div class="row">
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <p>The annual Leave entitlement is in accordance with Kenya labour law. As an Employee of eMobilis you are entitled to twenty-one (21) working days of Leave plus any public holidays in compliance with Kenya Labour Laws.</p>--}}
{{--                                                <br />--}}
{{--                                                <p>According to Section 29 of Employment Act, 2007, female employees shall be entitled to 3 Calendar months maternity Leave on full pay in addition to any period of annual Leave.</p>--}}
{{--                                                <br />--}}
{{--                                                <p>Male employees shall be entitled 2 Calendar weeks paternity Leave with full pay. And it cannot be extended without salary deduction.  The employee shall be required to produce a certificate of the expectant partner medical condition from a qualified medical practitioner or midwife.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" value="{{$applicant->name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" value="{{$applicant->email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" value="{{$applicant->phone}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employee Number</label>
                                                <input type="text" class="form-control" value="{{$applicant->employee_number}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Date of Leave Application</label>
                                                <input type="date" name="application_date" class="form-control" value="{{date("Y-m-d",strtotime($application->created_at))}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Leave Type</label>
                                                <input type="text" class="form-control" value="{{$array_string}}" disabled>
                                            </div>
                                        </div>
                                        @if($application->other_leave_type)
                                            <div class="col-md-12" id="otherSpecify">
                                                <div class="form-group">
                                                    <label>Other Leave Type</label>
                                                    <div class="form-check">
                                                        <input type="text" class="form-control" name="other_leave_type" value="{{$application->other_leave_type}}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>How many leave days are you taking?</label>
                                                <input type="text" class="form-control" value="{{$application->leave_days}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>First Day of Leave.</label>
                                                <input type="date" class="form-control" value="{{$application->leave_first_day}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Last Day of Leave.</label>
                                                <input type="date" class="form-control" value="{{$application->leave_last_day}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Where is your Duty Station?</label>
                                                <input type="text" class="form-control" value="{{$application->applicant_duty_station}}" readonly>
                                            </div>
                                        </div>
                                        @if($application->applicant_maternity_leave_due_date)
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>If taking maternity leave please indicate your due date below.</label>
                                                    <input type="date" class="form-control" value="{{$application->applicant_maternity_leave_due_date}}">
                                                </div>
                                            </div>
                                        @endif
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label>If you have taken sick off or study Leave, kindly attach doctors note or examination timetable</label>--}}
{{--                                                <input type="file" name="applicant_sick_off_study_leave_proof" class="form-control">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><b>Contact details of colleague who will take over roles and responsibilities</b></label>
                                                <p>Indicate the details of a colleague who will be taking your roles and responsibilities while you are away. Select someone who is near your working duty station and understands your roles and responsibilities. Prep them and ensure you share handover document with all pending tasks and links to all resources that are required to successfully complete the tasks</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Names</label>
                                                <input type="text" class="form-control" value="{{$application->colleague_name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" value="{{$application->colleague_email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" value="{{$application->colleague_phone}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input type="text" class="form-control" value="{{$application->colleague_designation}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Duty Station</label>
                                                <input type="text" class="form-control" value="{{$application->colleague_duty_station}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><b>Next of Kin Contact Details</b></label>
                                                <p>Indicate the details of your next of Kin. This information is important and required just in case anything happens and we cannot get in touch with you then we will contact your next of kin. This will be done only when necessary</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" value="{{$application->next_of_kin_name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" class="form-control" value="{{$application->next_of_kin_email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" value="{{$application->next_of_kin_phone}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Any other comment or concerns, please indicate below.</label>
                                                <input type="text" class="form-control" value="{{$application->general_comment_concern}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
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
