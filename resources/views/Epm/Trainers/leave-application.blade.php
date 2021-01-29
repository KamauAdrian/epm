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
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="f-w-400">Employee Leave Form</h1>
                </div>
            </div>
            <?php
                $types = '';
            ?>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="#!">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p>The annual leave entitlement is in accordance with Kenya labour law. As an Employee of eMobilis you are entitled to twenty-one (21) working days of leave plus any public holidays in compliance with Kenya Labour Laws.</p>
                                                <br />
                                                <p>According to Section 29 of Employment Act, 2007, female employees shall be entitled to 3 Calendar months maternity leave on full pay in addition to any period of annual leave.</p>
                                                <br />
                                                <p>Male employees shall be entitled 2 Calendar weeks paternity leave with full pay. And it cannot be extended without salary deduction.  The employee shall be required to produce a certificate of the expectant partner medical condition from a qualified medical practitioner or midwife.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" class="form-control" value="{{$application->applicant_name}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" value="{{$application->applicant_email}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" value="{{$application->applicant_phone}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employee Number</label>
                                                <input type="text" class="form-control" value="{{$application->applicant_employee_number}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Date of Leave Application</label>
                                                <input type="date" name="application_date" class="form-control" value="{{$application->application_date}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>What type of Leave are you taking?</label>
                                                <div class="form-check">
                                                    <input type="checkbox" value="Annual Leave" class="form-check-input" disabled>
                                                    <label class="form-check-label">Annual Leave</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" value="Sick Leave" class="form-check-input" disabled>
                                                    <label class="form-check-label">Sick Leave</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" value="Maternity Leave" class="form-check-input" disabled>
                                                    <label class="form-check-label">Maternity Leave</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" value="Study Leave" class="form-check-input" disabled>
                                                    <label class="form-check-label">Study Leave</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" value="Off day" class="form-check-input" disabled>
                                                    <label class="form-check-label">Off day - taken only if you worked during National Holiday</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkRole6" checked="checked" disabled>
                                                    <label class="form-check-label">Other</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="otherSpecify" style="display: none;">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="text" class="form-control" name="other_leave_type" placeholder="Please specify what type of leave you are taking">
                                                </div>
                                            </div>
                                        </div>
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
{{--                                                <label>If you have taken sick off or study leave, kindly attach doctors note or examination timetable</label>--}}
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
