@extends('Epm.Trainings.Layouts.days-master')

@section("sessionAllocations")
    <?php
    $auth_admin = auth()->user();
    $trainees = $trainingDay->trainees;
    ?>
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="08:30 AM">
                                                            <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="09:00 AM">
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="09:00 AM">
                                                            <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="11:00 AM">
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:15 AM">
                                                            <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="12:00 PM">
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="01:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="03:00 PM">
                                                        </div>
                                                        <a href="#!" data-toggle="modal" data-session_id="{{$session_5->id}}" id="{{$session_5->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                            <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                <i class="feather icon-plus"></i>
                                                            </button>
                                                        </a>
                                                    @endif
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="08:30 AM">
                                                            <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="09:00 AM">
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
                                            <td><b>Job Category 3:<br /> Digital Marketing & eCommerce</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Introduction to Digital Marketing<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Introduction to eCommerce<br />
                                                <span><i class="fa fa-arrow-right"></i></span> The E-Commerce industry in Kenya<br />
                                                Jumia<br />
                                                J-FORCE<br />
                                                Wowzi<br />
                                                Kilimall<br />
                                                <br />
                                                <b>Job Category 2: Digital Marketing Cont...</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to earn through Ad sense<br />
                                                <span><i class="fa fa-arrow-right"></i></span> SEO, SEM<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Email Marketing<br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to bid for  digital marketing jobs<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Tips to help you succeed in e-commerce business<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Sources to learn digital marketing skills<br />
                                                <br />
                                                <b>Job Category 2: Digital Marketing</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to start a social media business<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Autoresponders<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Examples of autoresponders<br />
                                                <br />
                                                <b>Job Category 2: Digital Marketing Cont...</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> <b>Social Media Marketing</b><br />
                                                Facebook<br />
                                                Twitter<br />
                                                LinkedIn<br />
                                                Instagram<br />
                                                Pinterest<br />
                                                YouTube<br />
                                                Yelp<br />
                                                <span><i class="fa fa-arrow-right"></i></span> What does it takes to be<br /> a social media manager?<br />
                                            </td>
                                            <td>
                                                @if($session_3)
                                                    @foreach($session_3->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="09:00 AM">
                                                            <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="11:00 AM">
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:15 AM">
                                                            <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="12:00 PM">
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="01:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="03:00 PM">
                                                        </div>
                                                        <a href="#!" data-toggle="modal" data-session_id="{{$session_5->id}}" id="{{$session_5->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                            <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                <i class="feather icon-plus"></i>
                                                            </button>
                                                        </a>
                                                    @endif
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
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="08:30 AM">
                                                            <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="09:00 AM">
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
                                            <td><b>Job Category 4: Transcription</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Introduction to Transcription<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Essential Tools you will require<br /> to transcribe<br />
                                                <span style="font-size: 20px;">.</span> Formatting Timestamps<br />
                                                <span style="font-size: 20px;">.</span> Transcription formats<br />
                                                <br />
                                                <b>Assignment : SEO<br />Content Writing 1<br />Individual<br /></b>
                                                <span><i class="fa fa-arrow-right"></i></span> Assignment on page<br />40 of the trainers<br />Manual<br />
                                            </td>
                                            <td>
                                                @if($session_3)
                                                    @foreach($session_3->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="09:00 AM">
                                                            <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="11:00 AM">
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
                                            <td><b>BIDDING PROCESS</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Procedure for Bidding<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Tips on writing<br /> successful bids<br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to accept and<br /> view a job offer<br /> and contract.<br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to submit work<br /> and request for<br /> payment on Upwork<br />
                                                <span><i class="fa fa-arrow-right"></i></span> How to get consistent<br /> online jobs and maintain<br /> long-term clients
                                            </td>
                                            <td>
                                                @if($session_4)
                                                    @foreach($session_4->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:15 AM">
                                                            <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="12:00 PM">
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
                                            <td><b>Job Category 4: Transcription</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Signing up on QA World<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Setting up GoTranscript<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Take away Transcription<br /> 2 (3) Individual Assignment<br /> on Page 90 of the<br /> Trainers Manual
                                            </td>
                                            <td>
                                                @if($session_5)
                                                    @foreach($session_5->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="01:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="03:00 PM">
                                                        </div>
                                                        <a href="#!" data-toggle="modal" data-session_id="{{$session_5->id}}" id="{{$session_5->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                            <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                <i class="feather icon-plus"></i>
                                                            </button>
                                                        </a>
                                                    @endif
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
    @if($trainingDay->day == 5)
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
                                            $session_2_end_time = date("H:i:s",strtotime("09:00 am"));
                                            $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                            ?>
                                            <td><b>8:30-9:00</b><br />
                                                (Duration: 30 minutes)
                                            </td>
                                            <td>
                                                Assignment presentation per group
                                            </td>
                                            <td>
                                                @if($session_2)
                                                    @foreach($session_2->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="08:30 AM">
                                                            <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="09:00 AM">
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
                                            <td><b>Job Category 5: <br />Data Entry/ Management</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Introduction to <br />Data Management/entry<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Clients who require data<br /> management services<br />
                                                <br />
                                                <b>Job Category 5: <br />Data Entry/ Management</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Cleaning data<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Sorting and Filtering<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Pivot Tables<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Data Visualization<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Formulas and Functions<br /> in Excel<br />
                                                <span><i class="fa fa-arrow-right"></i></span> A practical example of<br /> data entry gigs on Upwork.<br />
                                                <br />
                                                <b>Data Entry/ Management</b><br />
                                                <span><i class="fa fa-arrow-right"></i></span> Skills required for<br />
                                                data management<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Processing data to<br />
                                                different formats<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Sample profile of a<br />
                                                data entry expert<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Web Research<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Tools used by a <br />
                                                web researcher<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Skills required for <br />
                                                a web researcher<br />
                                                <span><i class="fa fa-arrow-right"></i></span> Techniques used for<br />
                                                web research
                                            </td>
                                            <td>
                                                @if($session_3)
                                                    @foreach($session_3->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="09:00 AM">
                                                            <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="11:00 AM">
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
                                            <td><b>Q & A Session & <br /> Transition to<br /> Mentorship<br />
                                                    MENTORSHIP <br />INDUCTION (5<br /> MENTORS TO <br />ONBOARD TRAINEES<br /> IN THE FIVE CATEGORIES)</b>
                                            </td>
                                            <td>
                                                @if($session_4)
                                                    @foreach($session_4->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:15 AM">
                                                            <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="12:00 PM">
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
                                            <td>JOB LINKAGE <br />
                                                KEPSA - Representative <br />
                                                <br />
                                                JUMIA Job <br /> Linkage <br /> Presentation, <br /> platform sign-up <br /> and Q&A Session.
                                            </td>
                                            <td>
                                                @if($session_5)
                                                    @foreach($session_5->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="01:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="03:00 PM">
                                                        </div>
                                                        <a href="#!" data-toggle="modal" data-session_id="{{$session_5->id}}" id="{{$session_5->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                            <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                <i class="feather icon-plus"></i>
                                                            </button>
                                                        </a>
                                                    @endif
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
                                        <tr>
                                            <?php
                                            $session_6_start_time = date("H:i:s",strtotime("04:00 pm"));
                                            $session_6_end_time = date("H:i:s",strtotime("04:45 pm"));
                                            $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                            ?>
                                            <td><b>4:00 - 4:45pm</b><br />
                                                (Duration:  45 minutes)
                                            </td>
                                            <td><b>Edith - Introduction of the<br /> Ajira Clubs Concept <br />
                                                    <br />
                                                    Introduction of Ajira Club<br /> Leaders to the Students.<br />
                                                    <br />
                                                    Determination of Next steps.</b>
                                            </td>
                                            <td>
                                                @if($session_6)
                                                    @foreach($session_6->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="04:00 PM">
                                                            <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="04:45 PM">
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
                                                            <input id="start_time_session_6" type="text" name="start_time" value="04:00 PM">
                                                            <input id="end_time_session_6" type="text" name="end_time" value="04:45 PM">
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
                                            $session_7_start_time = date("H:i:s",strtotime("04:45 pm"));
                                            $session_7_end_time = date("H:i:s",strtotime("05:15 pm"));
                                            $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                            ?>
                                            <td><b>4:45 pm - 5:15pm</b><br />
                                                (Duration:  30 minutes)
                                            </td>
                                            <td>
                                                <b>Awards of Best Trainees <br />
                                                    <br />
                                                    Closing Ceremony<br />
                                                    Ministry of ICT :</b>
                                                Closing Remarks and vote of Thanks.
                                            </td>
                                            <td>
                                                @if($session_7)
                                                    @foreach($session_7->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="04:45 PM">
                                                            <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="05:15 PM">
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
                                                            <input id="start_time_session_7" type="text" name="start_time" value="04:45 PM">
                                                            <input id="end_time_session_7" type="text" name="end_time" value="05:15 PM">
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
        <div class="card" style="height: 250px;">
            <div class="card-header">
                <h6>Communication</h6>
            </div>
            <div class="card-body text-center">
                <div class="media">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#!" title="Email All Trainees">
                                <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 100px;">
                                    <span><i class="fa fa-envelope"></i></span> <br> <p class="align-self-center">Email <br> Trainees</p>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#!" title="SMS All Trainees">
                                <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 100px;">
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
        <div class="card" style="height: 250px;">
            <div class="card-header">
                <h6>Progress</h6>
            </div>
            <div class="card-body text-center">
                <div class="media">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#!" title="Upload Photos">
                                <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 100px;">
                                    <span><i class="fa fa-image"></i></span> <br> <p class="align-self-center">Upload <br> Images</p>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#!" title="Impact Stories">
                                <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 100px;">
                                    <span><i class="fa fa-pencil-alt"></i></span><p class="align-self-center">Impact <br> Stories </p>
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
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trainees as $trainee)
                            <tr>
                                <td>{{$trainee->name}}</td>
                                <td>{{$trainee->email}}</td>
                                <td>{{$trainee->phone_number}}</td>
                                <td>{{$trainee->gender}}</td>
                                <td class="text-right">
                                    <div class="float-right">
                                        <a href="#!" class="btn btn-sm btn-outline-info">
                                            <span><i class="fa fa-envelope"></i></span>
                                        </a>
                                        <a href="#!" class="btn btn-sm btn-outline-info">
                                            <span><i class="fa fa-comment"></i></span>
                                        </a>
                                        <a href="#!" class="btn btn-sm btn-outline-danger">
                                            <span><i class="fa fa-trash"></i></span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="col-md-4">--}}
{{--        <div class="card" style="height: 250px;">--}}
{{--            <div class="card-header">--}}
{{--                <h6>Comments</h6>--}}
{{--            </div>--}}
{{--            <div class="card-body text-center">--}}
{{--                <div class="media">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <a href="#!" title="Upload Report">--}}
{{--                                <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px; width: 100px;">--}}
{{--                                    <span><i class="fa fa-comment"></i></span><p class="align-self-center">Add <br> Comment</p>--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <a href="#!" title="Upload Report">--}}
{{--                                <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px; width: 100px;">--}}
{{--                                    <span><i class="fa fa-book-open"></i></span><p class="align-self-center">View <br> Comment</p>--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
