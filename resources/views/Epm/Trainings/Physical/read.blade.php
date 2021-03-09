@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    $trainers = $trainingDay->trainers;
    $trainees = $trainingDay->trainees;
    $classes = $trainingDay->classes;
    $sessions = $trainingDay->sessions;
    ?>
    <div class="col-md-12">
        <div class="row">
            @if($trainingDay->day == 1)
                <div class="col-md-12">
                    <div class="card" style="height: 350px; overflow: auto;">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$trainingDay->day}}</h1>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th colspan="4">
                                                        Training Sessions Allocation
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Session</th>
                                                    <th>Facilitators</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php
                                                    $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                    $session_one_end_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                    ?>
                                                    <td><b>8:00- 8:30am</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <b>
                                                                <li>Arrival and Registration</li><br />
                                                                <li> Opening Prayer</li><br />
                                                            </b>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if($session_one)
                                                            @foreach($session_one->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                                @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                    <div style="display: none;">
                                                                        <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:00 AM">
                                                                        <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="08:30 AM">
                                                                    </div>
                                                                    <a href="#!" data-toggle="modal" data-session_id="{{$session_one->id}}" id="{{$session_one->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                        <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                            <i class="feather icon-plus"></i>
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_1" type="text" name="start_time" value="08:00 AM">
                                                                    <input id="end_time_session_1" type="text" name="end_time" value="08:30 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="1"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_2_start_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_2_end_time = date("H:i:s",strtotime("08:45 am"));
                                                    $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                    ?>
                                                    <td><b>8:30-8:45am</b><br />
                                                        (Duration: 15 minutes)
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <b>
                                                                <li> Covid 19 Health Protocols/ Code of Conduct.</li><br />
                                                                <li> Dos and Don'ts</li>
                                                            </b>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if($session_2)
                                                            @foreach($session_2->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="08:30 AM">
                                                                    <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="08:45 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_2->id}}" id="{{$session_2->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_2" type="text" name="start_time" value="08:30 AM">
                                                                    <input id="end_time_session_2" type="text" name="end_time" value="08:45 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="2"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_3_start_time = date("H:i:s",strtotime("08:45 am"));
                                                    $session_3_end_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                    ?>
                                                    <td><b>8:45-9:00</b><br />
                                                        (Duration: 15 minutes)
                                                    </td>
                                                    <td><b>Opening Ceremony</b><br />
                                                        <b>Remarks:</b> Ministry of ICT<br />
                                                        Madam Zilpher Owiti
                                                    </td>
                                                    <td>
                                                        @if($session_3)
                                                            @foreach($session_3->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="08:45 AM">
                                                                    <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="09:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_3->id}}" id="{{$session_3->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_3" type="text" name="start_time" value="08:45 AM">
                                                                    <input id="end_time_session_3" type="text" name="end_time" value="09:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="3"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_4_start_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_4_end_time = date("H:i:s",strtotime("10:00 am"));
                                                    $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                    ?>
                                                    <td><b>9:00-10:00 Am</b><br />
                                                        (Duration: 2hrs)
                                                    </td>
                                                    <td><b>Introduction to Online work</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Online work<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Advantages of online work<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Disadvantages of online work<br />
                                                        <br />
                                                        <b>GETTING STARTED AS AN ONLINE WORKER</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Basic tools to get you started<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Basic skills you require as an online worker
                                                    </td>
                                                    <td>
                                                        @if($session_4)
                                                            @foreach($session_4->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="09:00 AM">
                                                                    <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="10:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_4->id}}" id="{{$session_4->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_4" type="text" name="start_time" value="09:00 AM">
                                                                    <input id="end_time_session_4" type="text" name="end_time" value="10:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="4"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>Health Break: 10:00 am-10:15 am (15 minutes)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_6_start_time = date("H:i:s",strtotime("10:15 am"));
                                                    $session_6_end_time = date("H:i:s",strtotime("11:00 am"));
                                                    $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                                    ?>
                                                    <td><b>10:15am - 11:00am</b><br />
                                                        (Duration 45 Minutes )
                                                    </td>
                                                    <td><b>SOFT SKILLS</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Organizational skill<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Communication skills<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Online Ethics and netiquette<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Problem-solving skills<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Leadership skills<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Stress management skills<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Collaboration and teamwork<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Negotiation Skills
                                                    </td>
                                                    <td>
                                                        @if($session_6)
                                                            @foreach($session_6->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="10:15 AM">
                                                                    <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="11:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_6->id}}" id="{{$session_6->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_6" type="text" name="start_time" value="10:15 AM">
                                                                    <input id="end_time_session_6" type="text" name="end_time" value="11:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="6"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_7_start_time = date("H:i:s",strtotime("11:00 am"));
                                                    $session_7_end_time = date("H:i:s",strtotime("12:00 pm"));
                                                    $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                                    ?>
                                                    <td><b>11:00am - 12:00pm</b><br />
                                                        (Duration 1hour
                                                    </td>
                                                    <td><b>Jobs Available Online</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Virtual Assistant<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Writing and Translation<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Digital Marketing and ecommerce<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Data management<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Transcription
                                                    </td>
                                                    <td>
                                                        @if($session_7)
                                                            @foreach($session_7->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="11:00 AM">
                                                                    <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="12:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_7->id}}" id="{{$session_7->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_7" type="text" name="start_time" value="11:00 AM">
                                                                    <input id="end_time_session_7" type="text" name="end_time" value="12:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="7"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>LUNCH BREAK 12:00-1:00 pm (1 hour)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_9_start_time = date("H:i:s",strtotime("01:00 pm"));
                                                    $session_9_end_time = date("H:i:s",strtotime("03:00 pm"));
                                                    $session_9 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_9_start_time)->where("end_time",$session_9_end_time)->first();
                                                    ?>
                                                    <td><b>1:00 pm- 3:00pm</b><br />
                                                        (Duration:  2 Hours)
                                                    </td>
                                                    <td><b>Job Category 1: Virtual Assistance</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> VA Contracts<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Digital Calendar Management<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Email Management<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Designing using Canva.com<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Flight booking<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> DropBox Management
                                                    </td>
                                                    <td>
                                                        @if($session_9)
                                                            @foreach($session_9->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_{{$session_9->id}}" type="text" name="start_time" value="01:00 PM">
                                                                    <input id="end_time_session_{{$session_9->id}}" type="text" name="end_time" value="03:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" data-session_id="{{$session_9->id}}" id="{{$session_9->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_9" type="text" name="start_time" value="1:00 PM">
                                                                    <input id="end_time_session_9" type="text" name="end_time" value="3:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="9"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($trainingDay->day == 2)
                <div class="col-md-12">
                    <div class="card" style="height: 350px; overflow: auto;">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$trainingDay->day}}</h1>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th colspan="4">
                                                        Training Sessions Allocation
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Session</th>
                                                    <th>Facilitators</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php
                                                    $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                    $session_one_end_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                    ?>
                                                    <td><b>8:00- 8:30am</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <b>
                                                                <li>Arrival and Registration</li><br />
                                                                <li> Opening Prayer</li><br />
                                                                <li> Covid 19 Health Protocols/ Code of Conduct.</li><br />
                                                                <li> Dos and Don'ts</li>
                                                            </b>
                                                        </ul>
                                                    </td>
                                                        <td>
                                                            @if($session_one)
                                                                @foreach($session_one->facilitators as $facilitator)
                                                                    {{$facilitator->name}}<br />
                                                                @endforeach
                                                            @else
                                                                @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                    <div style="display: none;">
                                                                        <input id="start_time_session_1" type="text" name="start_time" value="08:00 AM">
                                                                        <input id="end_time_session_1" type="text" name="end_time" value="08:30 AM">
                                                                    </div>
                                                                    <a href="#!" data-toggle="modal" id="1"  class="openModalUpdateSessionFacilitators float-right">
                                                                        <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                            <i class="feather icon-plus"></i>
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_2_start_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_2_end_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                    ?>
                                                    <td><b>8:30-9:00</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>Recap of previous day<br />
                                                        training and assignment
                                                    </td>
                                                        <td>
                                                            @if($session_2)
                                                                @foreach($session_2->facilitators as $facilitator)
                                                                    {{$facilitator->name}}<br />
                                                                @endforeach
                                                            @else
                                                                @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                    <div style="display: none;">
                                                                        <input id="start_time_session_2" type="text" name="start_time" value="08:30 AM">
                                                                        <input id="end_time_session_2" type="text" name="end_time" value="09:00 AM">
                                                                    </div>
                                                                    <a href="#!" data-toggle="modal" id="2"  class="openModalUpdateSessionFacilitators float-right">
                                                                        <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                            <i class="feather icon-plus"></i>
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_3_start_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_3_end_time = date("H:i:s",strtotime("11:00 am"));
                                                    $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                    ?>
                                                    <td><b>9:00-11:00 Am</b><br />
                                                        (Duration: 2hrs)
                                                    </td>
                                                    <td><b>Job Category 2: Content Writing</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Introduction to Content Writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Clients who require content writing services<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Roles of content writers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Skills required Tools required for content writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Common types of content writing jobs you can find on online<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Referencing work and avoiding plagiarism<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Plagiarism checkers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> How to make money blogging<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Sample profile for a content writer
                                                    </td>
                                                    <td>
                                                        @if($session_3)
                                                            @foreach($session_3->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_3" type="text" name="start_time" value="09:00 AM">
                                                                    <input id="end_time_session_3" type="text" name="end_time" value="11:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="3"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>Health Break: 11:00 am-11:15 am (15 minutes)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_4_start_time = date("H:i:s",strtotime("11:15 am"));
                                                    $session_4_end_time = date("H:i:s",strtotime("12:00 pm"));
                                                    $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                    ?>
                                                    <td><b>11:15am - 12:00pm</b><br />
                                                        (Duration 45 Minutes )
                                                    </td>
                                                    <td><b>Payment Method</b> <br /> (Opening paypal Account)
                                                    </td>
                                                    <td>
                                                        @if($session_4)
                                                            @foreach($session_4->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_4" type="text" name="start_time" value="11:15 AM">
                                                                    <input id="end_time_session_4" type="text" name="end_time" value="12:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="4"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>LUNCH BREAK 12:00-1:00 pm (1 hour)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_5_start_time = date("H:i:s",strtotime("01:00 pm"));
                                                    $session_5_end_time = date("H:i:s",strtotime("03:00 pm"));
                                                    $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                    ?>
                                                    <td><b>1:00 pm- 3:00pm</b><br />
                                                        (Duration:  2 Hours)
                                                    </td>
                                                    <td><b>SIGNING-UP ON ONLINE PLATFORMS</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Upwork<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Fiverr<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Guru.com
                                                    </td>
                                                    <td>
                                                        @if($session_5)
                                                            @foreach($session_5->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_5" type="text" name="start_time" value="01:00 PM">
                                                                    <input id="end_time_session_5" type="text" name="end_time" value="03:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="5"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($trainingDay->day == 3)
                <div class="col-md-12">
                    <div class="card" style="height: 350px; overflow: auto;">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$trainingDay->day}}</h1>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th colspan="4">
                                                        Training Sessions Allocation
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Session</th>
                                                    <th>Facilitators</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php
                                                    $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                    $session_one_end_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                    ?>
                                                    <td><b>8:00- 8:30am</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <b>
                                                                <li>Arrival and Registration</li><br />
                                                                <li> Opening Prayer</li><br />
                                                                <li> Covid 19 Health Protocols/ Code of Conduct.</li><br />
                                                                <li> Dos and Don'ts</li>
                                                            </b>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if($session_one)
                                                            @foreach($session_one->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_1" type="text" name="start_time" value="08:00 AM">
                                                                    <input id="end_time_session_1" type="text" name="end_time" value="08:30 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="1"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_2_start_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_2_end_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                    ?>
                                                    <td><b>8:30-9:00</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>Recap of previous day<br />
                                                        training and assignment
                                                    </td>
                                                    <td>
                                                        @if($session_2)
                                                            @foreach($session_2->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_2" type="text" name="start_time" value="08:30 AM">
                                                                    <input id="end_time_session_2" type="text" name="end_time" value="09:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="2"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_3_start_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_3_end_time = date("H:i:s",strtotime("11:00 am"));
                                                    $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                    ?>
                                                    <td><b>9:00-11:00 Am</b><br />
                                                        (Duration: 2hrs)
                                                    </td>
                                                    <td><b>Job Category 2: Content Writing</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Introduction to Content Writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Clients who require content writing services<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Roles of content writers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Skills required Tools required for content writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Common types of content writing jobs you can find on online<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Referencing work and avoiding plagiarism<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Plagiarism checkers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> How to make money blogging<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Sample profile for a content writer
                                                    </td>
                                                    <td>
                                                        @if($session_3)
                                                            @foreach($session_3->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_3" type="text" name="start_time" value="09:00 AM">
                                                                    <input id="end_time_session_3" type="text" name="end_time" value="11:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="3"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>Health Break: 11:00 am-11:15 am (15 minutes)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_4_start_time = date("H:i:s",strtotime("11:15 am"));
                                                    $session_4_end_time = date("H:i:s",strtotime("12:00 pm"));
                                                    $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                    ?>
                                                    <td><b>11:15am - 12:00pm</b><br />
                                                        (Duration 45 Minutes )
                                                    </td>
                                                    <td><b>Payment Method</b> <br /> (Opening paypal Account)
                                                    </td>
                                                    <td>
                                                        @if($session_4)
                                                            @foreach($session_4->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_4" type="text" name="start_time" value="11:15 AM">
                                                                    <input id="end_time_session_4" type="text" name="end_time" value="12:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="4"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>LUNCH BREAK 12:00-1:00 pm (1 hour)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_5_start_time = date("H:i:s",strtotime("01:00 pm"));
                                                    $session_5_end_time = date("H:i:s",strtotime("03:00 pm"));
                                                    $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                    ?>
                                                    <td><b>1:00 pm- 3:00pm</b><br />
                                                        (Duration:  2 Hours)
                                                    </td>
                                                    <td><b>SIGNING-UP ON ONLINE PLATFORMS</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Upwork<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Fiverr<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Guru.com
                                                    </td>
                                                    <td>
                                                        @if($session_5)
                                                            @foreach($session_5->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_5" type="text" name="start_time" value="01:00 PM">
                                                                    <input id="end_time_session_5" type="text" name="end_time" value="03:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="5"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($trainingDay->day == 4)
                <div class="col-md-12">
                    <div class="card" style="height: 350px; overflow: auto;">
                        <div class="card-body">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-12 text-center mb-2">
                                        <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$trainingDay->day}}</h1>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th colspan="4">
                                                        Training Sessions Allocation
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Session</th>
                                                    <th>Facilitators</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php
                                                    $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                    $session_one_end_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                    ?>
                                                    <td><b>8:00- 8:30am</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <b>
                                                                <li>Arrival and Registration</li><br />
                                                                <li> Opening Prayer</li><br />
                                                                <li> Covid 19 Health Protocols/ Code of Conduct.</li><br />
                                                                <li> Dos and Don'ts</li>
                                                            </b>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if($session_one)
                                                            @foreach($session_one->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_1" type="text" name="start_time" value="08:00 AM">
                                                                    <input id="end_time_session_1" type="text" name="end_time" value="08:30 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="1"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_2_start_time = date("H:i:s",strtotime("08:30 am"));
                                                    $session_2_end_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                    ?>
                                                    <td><b>8:30-9:00</b><br />
                                                        (Duration: 30 minutes)
                                                    </td>
                                                    <td>Recap of previous day<br />
                                                        training and assignment
                                                    </td>
                                                    <td>
                                                        @if($session_2)
                                                            @foreach($session_2->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_2" type="text" name="start_time" value="08:30 AM">
                                                                    <input id="end_time_session_2" type="text" name="end_time" value="09:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="2"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_3_start_time = date("H:i:s",strtotime("09:00 am"));
                                                    $session_3_end_time = date("H:i:s",strtotime("11:00 am"));
                                                    $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                    ?>
                                                    <td><b>9:00-11:00 Am</b><br />
                                                        (Duration: 2hrs)
                                                    </td>
                                                    <td><b>Job Category 2: Content Writing</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Introduction to Content Writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Clients who require content writing services<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Roles of content writers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Skills required Tools required for content writing<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Common types of content writing jobs you can find on online<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Referencing work and avoiding plagiarism<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Plagiarism checkers<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> How to make money blogging<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Sample profile for a content writer
                                                    </td>
                                                    <td>
                                                        @if($session_3)
                                                            @foreach($session_3->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_3" type="text" name="start_time" value="09:00 AM">
                                                                    <input id="end_time_session_3" type="text" name="end_time" value="11:00 AM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="3"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>Health Break: 11:00 am-11:15 am (15 minutes)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_4_start_time = date("H:i:s",strtotime("11:15 am"));
                                                    $session_4_end_time = date("H:i:s",strtotime("12:00 pm"));
                                                    $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                    ?>
                                                    <td><b>11:15am - 12:00pm</b><br />
                                                        (Duration 45 Minutes )
                                                    </td>
                                                    <td><b>Payment Method</b> <br /> (Opening paypal Account)
                                                    </td>
                                                    <td>
                                                        @if($session_4)
                                                            @foreach($session_4->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_4" type="text" name="start_time" value="11:15 AM">
                                                                    <input id="end_time_session_4" type="text" name="end_time" value="12:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="4"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" colspan="3">
                                                        <b>LUNCH BREAK 12:00-1:00 pm (1 hour)</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $session_5_start_time = date("H:i:s",strtotime("01:00 pm"));
                                                    $session_5_end_time = date("H:i:s",strtotime("03:00 pm"));
                                                    $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                    ?>
                                                    <td><b>1:00 pm- 3:00pm</b><br />
                                                        (Duration:  2 Hours)
                                                    </td>
                                                    <td><b>SIGNING-UP ON ONLINE PLATFORMS</b><br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Upwork<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Fiverr<br />
                                                        <span><i class="fa fa-arrow-right"></i></span> Guru.com
                                                    </td>
                                                    <td>
                                                        @if($session_5)
                                                            @foreach($session_5->facilitators as $facilitator)
                                                                {{$facilitator->name}}<br />
                                                            @endforeach
                                                        @else
                                                            @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                                <div style="display: none;">
                                                                    <input id="start_time_session_5" type="text" name="start_time" value="01:00 PM">
                                                                    <input id="end_time_session_5" type="text" name="end_time" value="03:00 PM">
                                                                </div>
                                                                <a href="#!" data-toggle="modal" id="5"  class="openModalUpdateSessionFacilitators float-right">
                                                                    <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                        <i class="feather icon-plus"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Trainees</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    {{--                            <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/upload/trainees')}}" title="Upload Trainees Excel file">--}}
                                    <a href="#!" title="Upload Trainees Excel file">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-upload"></i></span><br> <p class="align-self-center">Upload <br> Trainees</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    {{--                            <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/add/trainees')}}" title="Add Trainee">--}}
                                    <a href="#!" title="Add Trainee">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-plus"></i></span> <br> <p class="align-self-center">Add <br>Trainee</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Communication</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Email All Trainees">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-envelope"></i></span> <br> <p class="align-self-center">Email <br> Trainees</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="SMS All Trainees">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-comment"></i></span> <br> <p class="align-self-center">SMS <br>Trainees</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Progress</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Photos">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;width: 150px;">
                                            <span><i class="fa fa-image"></i></span> <br> <p class="align-self-center">Upload <br> Images</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="Impact Stories">
                                        <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                            <span><i class="fa fa-pencil-alt"></i></span><p class="align-self-center">Impact <br> Stories </p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6>Comments</h6>
                    </div>
                    <div class="card-body">
                        <div class="media">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Report">
                                        <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-comment"></i></span><p class="align-self-center">Add <br> Comment</p>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!" title="Upload Report">
                                        <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                            <span><i class="fa fa-book-open"></i></span><p class="align-self-center">View <br> Comments</p>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h6 class="text-small">Trainees</h6></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="traineesList" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Category</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                        @foreach($trainees as $trainee)--}}
                                {{--                            <tr>--}}
                                {{--                                <td>{{$trainee->name}}</td>--}}
                                {{--                                <td>{{$trainee->email}}</td>--}}
                                {{--                                <td>{{$trainee->phone_number}}</td>--}}
                                {{--                                <td>{{$trainee->gender}}</td>--}}
                                {{--                                <td>{{$trainee->category}}</td>--}}
                                {{--                                <td class="text-right">--}}
                                {{--                                    <div class="float-right">--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                                {{--                                            <span><i class="fa fa-envelope"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                                {{--                                            <span><i class="fa fa-comment"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                        <a href="#!" class="btn btn-sm btn-outline-danger">--}}
                                {{--                                            <span><i class="fa fa-trash"></i></span>--}}
                                {{--                                        </a>--}}
                                {{--                                    </div>--}}
                                {{--                                </td>--}}
                                {{--                            </tr>--}}
                                {{--                        @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalUpdateSessionFacilitators" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12" id="modalTrainingUpdate">
                                    <form id="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12" style="display: none;">
                                                <div class="form-group">
                                                    <label>Session Start Time</label>
                                                    <input class="form-control" type="text" id="session_start_time" name="start_time" value="">
                                                    <input class="form-control" type="hidden" id="training_id" value="{{$trainingDay->training->id}}">
                                                    <input class="form-control" type="hidden" id="day_id" value="{{$trainingDay->id}}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Session End Time</label>
                                                    <input class="form-control" type="text" id="session_end_time" name="end_time" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group" session_id="" id="trainingFacilitators" training_id="{{$trainingDay->training->id}}">
                                                    <label>Select Session Facilitators</label>
                                                    <multiselect v-model="selectedTrainers" :options="trainers"
                                                                 placeholder="Select Trainers" label="name" :track-by="trackBy"
                                                                 :searchable="true" :close-on-select="true" multiple>
                                                    </multiselect>
                                                    {{--                                                        <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">--}}
                                                    <input id="session_facilitators" type="hidden" v-for="trainer in selectedTrainers" name="trainers[]" :value="trainer.id">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group float-right">
                                                    <input type="submit" class="btn btn-outline-info" value="Save">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        $('.openModalUpdateSessionFacilitators').click(function(event){
            event.preventDefault();
            let formId = $(this).attr("id");
            let sessionId = $(this).attr("data-session_id");
            let form = $("#modalTrainingUpdate").children(":first");
            $("#trainingFacilitators").attr("session_id",sessionId);
            form.attr("id","facilitatorsAddToSession_"+formId);
            let startTime = $("#start_time_session_"+formId).val();
            let endTime = $("#end_time_session_"+formId).val();
            $("#session_start_time").val(startTime);
            $("#session_end_time").val(endTime);

            $("#modalUpdateSessionFacilitators").modal('show');
        });
        $("#modalUpdateSessionFacilitators").on("show.bs.modal",function (){
            let id = $("#modalTrainingUpdate").children(":first").attr("id");
            let formAddFacilitators = document.getElementById(id);
            // let formAddFacilitators = $(id);
            formAddFacilitators.onsubmit = function(event) {
                // Populate hidden form on submit
                // alert("submitting form");
                $.ajaxSetup({
                    header:$('meta[name="_token"]').attr('content')
                })
                event.preventDefault();
                var user_id = {{auth()->user()->id}};
                var training_id = $("#training_id").val();
                var day_id = $("#day_id").val();
                console.log(user_id,training_id,day_id);
                var startTime = $("#session_start_time").val();
                var endTime = $("#session_end_time").val();
                var trainers = $("#session_facilitators").val();
                var formData = $(formAddFacilitators).serializeArray();
                // console.log('wololo this is what i found '+user_id,training_id,day_id);
                $.ajax({
                    url: '/adm/'+user_id+'/add/training/'+training_id+'/day/'+day_id+'/facilitators',
                    type: 'post',
                    data:formData,
                    success: function(response){
                        if (response.url){
                            $("#modalUpdateSessionFacilitators").modal('hide');
                            window.location = response.url;
                        }
                    }
                });
                return true;
            };
        });

        $('#traineesList').DataTable();
        new Vue({
            el: "#trainingFacilitators",
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data: function () {
                return {
                    trackBy:"id",
                    selectedTrainers: [],
                    trainers: [],
                    initialValues: [],
                }
            },
            methods:{
                getTrainers: function(){
                    axios
                        .get("/training/"+this.$el.attributes.training_id.value+"/facilitators")
                        .then(response => {
                            this.trainers = response.data;
                            // this.allClasses = response.data;
                            // this.updateClasses();
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true);
                },
                // updateClasses: function () {
                //     let total = this.allClasses.length;
                //     for (i=0;i<total;i++){
                //         let all = this.classes.push(this.allClasses[i]);
                //     }
                // },
            },
            mounted () {
                this.getTrainers();
            },
            watch: {
                trainers:{
                    immediate: false,
                    handler(values){
                        console.log(this.$el.attributes.session_id.value);
                        axios.get("/training/session/"+this.$el.attributes.session_id.value+"/facilitators").then(response => {this.initialValues = response.data;});
                    },
                },
                initialValues: {
                    immediate: true,
                    handler(values) {
                        this.selectedTrainers = this.trainers.filter(r => values.includes(r[this.trackBy]));
                    }
                }
            },
        });
    </script>
@endsection
