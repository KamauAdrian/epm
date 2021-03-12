@extends('Epm.Trainings.Layouts.days-master')

@section("sessionAllocations")
    <?php
    $auth_admin = auth()->user();
    ?>
    @if($trainingDay->day == 1)
        <div class="col-md-12">
            <div class="card" style="height: 350px; overflow: auto;">
                <div class="card-body">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12 text-center mb-2">
                                <h1 class="d-inline-block mb-0 font-weight-normal">{{$category->name}} Day {{$trainingDay->day}}</h1>
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
                                        @if($category->name == "Data Entry/Management")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:30 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:30 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:30 - 9:30am</b>
                                                </td>
                                                <td>
                                                    Introduction to online work
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:30 AM">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="09:30 AM">
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
                                                                <input id="start_time_session_1" type="text" name="start_time" value="08:30 AM">
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:30 AM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>Health Break: 09:30 - 09:40 am</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:40 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("11:00 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:40 - 11:00am</b>
                                                </td>
                                                <td>
                                                    Overview of online job categories
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="09:40 AM">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="11:00 AM">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:40 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="11:00 AM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>Health Break: 11:00 - 11:10 am</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("11:10 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("12:30 pm"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:10 - 12:30pm</b>
                                                </td>
                                                <td>
                                                    Signing up on online job platforms
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="12:30 PM">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="12:30 PM">
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
                                                $session_4_start_time = date("H:i:s",strtotime("12:30 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("01:00 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>12:30 – 1:00pm</b>
                                                </td>
                                                <td>
                                                    Q&A
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="12:30 PM">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="01:00 PM">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="12:30 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="01:00 PM">
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
                                                    <b>LUNCH BREAK 1:00 - 2:00pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("02:00 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("02:50 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>2:00 – 2:50pm</b>
                                                </td>
                                                <td>
                                                    Data Entry
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_5->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="02:00 PM">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="02:50 PM">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="02:00 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="02:50 PM">
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
                                                $session_6_start_time = date("H:i:s",strtotime("03:00 pm"));
                                                $session_6_end_time = date("H:i:s",strtotime("04:15 pm"));
                                                $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:00 – 4:15pm</b>
                                                </td>
                                                <td>
                                                    Excel
                                                </td>
                                                <td>
                                                    @if($session_6)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="03:00 PM">
                                                                <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="04:15 PM">
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
                                                                <input id="start_time_session_6" type="text" name="start_time" value="03:00 PM">
                                                                <input id="end_time_session_6" type="text" name="end_time" value="04:15 PM">
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
                                                $session_7_start_time = date("H:i:s",strtotime("04:15 pm"));
                                                $session_7_end_time = date("H:i:s",strtotime("04:30 pm"));
                                                $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:15 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    Kahoot
                                                </td>
                                                <td>
                                                    @if($session_7)
                                                        @foreach($session_7->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="04:15 PM">
                                                                <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="04:30 PM">
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
                                                                <input id="start_time_session_7" type="text" name="start_time" value="04:15 PM">
                                                                <input id="end_time_session_7" type="text" name="end_time" value="04:30 PM">
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
                                        @endif
                                        @if($category->name == "Virtual Assistant")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:00 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:00 - 9:00 am</b>
                                                </td>
                                                <td>
                                                    Introduction to online work
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:00 AM">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="09:00 AM">
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
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:00 AM">
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
                                                $session_2_start_time = date("H:i:s",strtotime("09:05 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("10:05 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>9:05 – 10:05am</b>
                                                </td>
                                                <td>
                                                    Job Categories
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="09:05 AM">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="10:05 AM">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:05 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="10:05 AM">
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
                                                $session_3_start_time = date("H:i:s",strtotime("10:15 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("11:30 am"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>10:15 – 11:30am</b>
                                                </td>
                                                <td>
                                                    VA services
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="{{$session_3->start_time}}">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="{{$session_3->end_time}}">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="10:15 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="11:30 AM">
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
                                                $session_4_start_time = date("H:i:s",strtotime("11:35 am"));
                                                $session_4_end_time = date("H:i:s",strtotime("12:50 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:35 - 12:50pm</b>
                                                </td>
                                                <td>
                                                    VA Contracts
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="{{$session_4->start_time}}">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="{{$session_4->end_time}}">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="11:35 AM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="12:50 PM">
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
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("12:50 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("01:00 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>12:50 – 1:00pm</b>
                                                </td>
                                                <td>
                                                    QA 10min
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_5->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="{{$session_5->start_time}}">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="{{$session_5->end_time}}">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="12:50 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="01:00 PM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>LUNCH BREAK 1:00 - 1:45 pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_6_start_time = date("H:i:s",strtotime("1:45 pm"));
                                                $session_6_end_time = date("H:i:s",strtotime("3:00 pm"));
                                                $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>1:45 – 3:00pm</b>
                                                </td>
                                                <td>
                                                    calendly
                                                </td>
                                                <td>
                                                    @if($session_6)
                                                        @foreach($session_6->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="{{$session_6->start_time}}">
                                                                <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="{{$session_6->end_time}}">
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
                                                                <input id="start_time_session_6" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_6" type="text" name="end_time" value="3:00 PM">
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
                                                $session_7_start_time = date("H:i:s",strtotime("3:05 pm"));
                                                $session_7_end_time = date("H:i:s",strtotime("4:15 pm"));
                                                $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:05 – 4:15pm</b>
                                                </td>
                                                <td>
                                                    Upwork
                                                </td>
                                                <td>
                                                    @if($session_7)
                                                        @foreach($session_7->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="{{$session_7->start_time}}">
                                                                <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="{{$session_7->end_time}}">
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
                                                                <input id="start_time_session_7" type="text" name="start_time" value="2:25 PM">
                                                                <input id="end_time_session_7" type="text" name="end_time" value="3:00 PM">
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
                                                <?php
                                                $session_8_start_time = date("H:i:s",strtotime("4:15 pm"));
                                                $session_8_end_time = date("H:i:s",strtotime("4:30 pm"));
                                                $session_8 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_8_start_time)->where("end_time",$session_8_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:15 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    kahoot
                                                </td>
                                                <td>
                                                    @if($session_8)
                                                        @foreach($session_8->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_8->id}}" type="text" name="start_time" value="{{$session_8->start_time}}">
                                                                <input id="end_time_session_{{$session_8->id}}" type="text" name="end_time" value="{{$session_8->end_time}}">
                                                            </div>
                                                            <a href="#!" data-toggle="modal" data-session_id="{{$session_8->id}}" id="{{$session_8->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                    <i class="feather icon-plus"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_8" type="text" name="start_time" value="4:15 PM">
                                                                <input id="end_time_session_8" type="text" name="end_time" value="4:30 PM">
                                                            </div>
                                                            <a href="#!" data-toggle="modal" id="8"  class="openModalUpdateSessionFacilitators float-right">
                                                                <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                    <i class="feather icon-plus"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endif
                                        @if($category->name == "Transcription")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:20 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:20 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:20 - 9:20am</b>
                                                </td>
                                                <td>
                                                    INTRODUCTION TO ONLINE WORK AND SOFT SKILLS
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="{{$session_one->start_time}}">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="{{$session_one->end_time}}">
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
                                                                <input id="start_time_session_1" type="text" name="start_time" value="08:20 AM">
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:20 AM">
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
{{--                                            <tr>--}}
{{--                                                <td class="text-center" colspan="3">--}}
{{--                                                    <b>Health Break: 09:30 - 09:40 am</b>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:25 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("09:55 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:25 - 09:55am</b>
                                                </td>
                                                <td>
                                                    OVERVIEW OF JOB CATEGORIES
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="{{$session_2->start_time}}">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="{{$session_2->end_time}}">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:25 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="09:55 AM">
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
{{--                                            <tr>--}}
{{--                                                <td class="text-center" colspan="3">--}}
{{--                                                    <b>Health Break: 09:55 - 10:00 am</b>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("10:00 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("01:00 pm"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>10:00 - 01:00pm</b>
                                                </td>
                                                <td>
                                                    TRANSCRIPTION THEORY AND OTTER PRACTICAL
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="{{$session_3->start_time}}">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="{{$session_3->end_time}}">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="10:00 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="1:00 PM">
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
                                                    <b>LUNCH BREAK 1:00 - 1:45pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_4_start_time = date("H:i:s",strtotime("1:45 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("4:00 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>1:45 – 4:00pm</b>
                                                </td>
                                                <td>
                                                    QA WORLD AND PAYPAL PRACTICAL
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="{{$session_4->start_time}}">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="{{$session_4->end_time}}">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="04:00 PM">
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
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("04:00 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("04:30 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:00 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    KAHOOT AND MOTIVATIONAL TALK
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_5->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="{{$session_5->start_time}}">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="{{$session_5->end_time}}">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="4:00 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="04:30 PM">
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
                                        @endif
                                        @if($category->name == "Digital Marketing/Ecommerce")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:00 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:00 - 9:00am</b>
                                                </td>
                                                <td>
                                                    Introduction to online work<br />
                                                    Soft skills
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="{{$session_one->start_time}}">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="{{$session_one->end_time}}">
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
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:00 AM">
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
{{--                                            <tr>--}}
{{--                                                <td class="text-center" colspan="3">--}}
{{--                                                    <b>Health Break: 09:30 - 09:40 am</b>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:00 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("11:00 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:00 - 11:00am</b>
                                                </td>
                                                <td>
                                                    Jobs Available Online <br />
                                                    Overview of the five Job Categories
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="{{$session_2->start_time}}">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="{{$session_2->end_time}}">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:00 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="11:00 AM">
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
{{--                                            <tr>--}}
{{--                                                <td class="text-center" colspan="3">--}}
{{--                                                    <b>Health Break: 11:00 - 11:10 am</b>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("11:10 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("1:00 pm"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:10 - 1:00pm</b>
                                                </td>
                                                <td>
                                                    Opening an Upwork/ Fiverr Account<br />
                                                    Link to payment Method
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="{{$session_3->start_time}}">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="{{$session_3->end_time}}">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="1:00 PM">
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
                                                        <b>LUNCH BREAK 1:00 - 2:00pm</b>
                                                    </td>
                                                </tr>
                                            <tr>
                                                <?php
                                                $session_4_start_time = date("H:i:s",strtotime("1:45 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("3:15 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>1:45 – 3:15pm</b>
                                                </td>
                                                <td>
                                                    Social Media Marketing(SMM)<br />
                                                    Youtube Marketing
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="{{$session_4->start_time}}">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="{{$session_4->end_time}}">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="3:15 PM">
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
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("3:20 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("04:20 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:20 – 4:20pm</b>
                                                </td>
                                                <td>
                                                    Ecommerce
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="{{$session_5->start_time}}">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="{{$session_5->end_time}}">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="03:20 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="04:20 PM">
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
                                        @endif
                                        @if($category->name == "Content Writing and Translation")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:30 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:30 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:30 - 9:30am</b>
                                                </td>
                                                <td>
                                                    Introduction to online work
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:30 AM">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="09:30 AM">
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
                                                                <input id="start_time_session_1" type="text" name="start_time" value="08:30 AM">
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:30 AM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>Health Break: 09:30 - 09:40 am</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:40 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("11:00 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:40 - 11:00am</b>
                                                </td>
                                                <td>
                                                    Overview of online job categories
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="09:40 AM">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="11:00 AM">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:40 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="11:00 AM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>Health Break: 11:00 - 11:10 am</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("11:10 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("12:30 pm"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:10 - 12:30pm</b>
                                                </td>
                                                <td>
                                                    Signing up on online job platforms
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="12:30 PM">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="12:30 PM">
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
                                                $session_4_start_time = date("H:i:s",strtotime("12:30 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("01:00 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>12:30 – 1:00pm</b>
                                                </td>
                                                <td>
                                                    Q&A
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="12:30 PM">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="01:00 PM">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="12:30 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="01:00 PM">
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
                                                    <b>LUNCH BREAK 1:00 - 2:00pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("02:00 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("02:50 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>2:00 – 2:50pm</b>
                                                </td>
                                                <td>
                                                    Data Entry
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="02:00 PM">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="02:50 PM">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="02:00 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="02:50 PM">
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
                                                $session_6_start_time = date("H:i:s",strtotime("03:00 pm"));
                                                $session_6_end_time = date("H:i:s",strtotime("04:15 pm"));
                                                $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:00 – 4:15pm</b>
                                                </td>
                                                <td>
                                                    Excel
                                                </td>
                                                <td>
                                                    @if($session_6)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="03:00 PM">
                                                                <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="04:15 PM">
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
                                                                <input id="start_time_session_6" type="text" name="start_time" value="03:00 PM">
                                                                <input id="end_time_session_6" type="text" name="end_time" value="04:15 PM">
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
                                                $session_7_start_time = date("H:i:s",strtotime("04:15 pm"));
                                                $session_7_end_time = date("H:i:s",strtotime("04:30 pm"));
                                                $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:15 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    Kahoot
                                                </td>
                                                <td>
                                                    @if($session_7)
                                                        @foreach($session_7->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="04:15 PM">
                                                                <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="04:30 PM">
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
                                                                <input id="start_time_session_7" type="text" name="start_time" value="04:15 PM">
                                                                <input id="end_time_session_7" type="text" name="end_time" value="04:30 PM">
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
                                        @endif
                                    </table>
                                </div>
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 text-center mb-2">
                                <h1 class="d-inline-block mb-0 font-weight-normal">{{$category->name}} Day {{$trainingDay->day}}</h1>
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
                                        @if($category->name == "Data Entry/Management")
                                        <tbody>
                                        <tr>
                                            <?php
                                            $session_one_start_time = date("H:i:s",strtotime("08:20 am"));
                                            $session_one_end_time = date("H:i:s",strtotime("09:30 am"));
                                            $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                            ?>
                                            <td>
                                                <b>8:20 – 9:30am</b>
                                            </td>
                                            <td>
                                                Recap of previous day training and assignment
                                            </td>
                                            <td>
                                                @if($session_one)
                                                    @foreach($session_one->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:20 AM">
                                                            <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="09:30 AM">
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
                                                            <input id="start_time_session_1" type="text" name="start_time" value="08:20 AM">
                                                            <input id="end_time_session_1" type="text" name="end_time" value="09:30 AM">
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
                                            $session_2_start_time = date("H:i:s",strtotime("09:40 am"));
                                            $session_2_end_time = date("H:i:s",strtotime("10:30 am"));
                                            $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                            ?>
                                            <td>
                                                <b>9:40 – 10:30am</b>
                                            </td>
                                            <td>
                                                Review of online job account created
                                            </td>
                                            <td>
                                                @if($session_2)
                                                    @foreach($session_2->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="09:40 AM">
                                                            <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="10:30 AM">
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
                                                            <input id="start_time_session_2" type="text" name="start_time" value="09:40 AM">
                                                            <input id="end_time_session_2" type="text" name="end_time" value="10:30 AM">
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
                                            $session_3_start_time = date("H:i:s",strtotime("10:50 am"));
                                            $session_3_end_time = date("H:i:s",strtotime("11:30 am"));
                                            $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                            ?>
                                            <td>
                                                <b>10:50 – 11:30am</b>
                                            </td>
                                            <td>
                                                Payment Methods
                                            </td>
                                            <td>
                                                @if($session_3)
                                                    @foreach($session_3->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="10:50 AM">
                                                            <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="11:30 AM">
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
                                                            <input id="start_time_session_3" type="text" name="start_time" value="10:30 AM">
                                                            <input id="end_time_session_3" type="text" name="end_time" value="11:30 AM">
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
                                            $session_4_start_time = date("H:i:s",strtotime("11:40 am"));
                                            $session_4_end_time = date("H:i:s",strtotime("01:00 pm"));
                                            $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                            ?>
                                            <td>
                                                <b>11:40am - 1:00pm</b>
                                            </td>
                                            <td>
                                                Bidding
                                            </td>
                                            <td>
                                                @if($session_4)
                                                    @foreach($session_4->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:40 AM">
                                                            <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="01:00 PM">
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
                                                            <input id="start_time_session_4" type="text" name="start_time" value="11:40 AM">
                                                            <input id="end_time_session_4" type="text" name="end_time" value="01:00 PM">
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
                                                <b>LUNCH BREAK 1:00 - 2:00 pm</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $session_5_start_time = date("H:i:s",strtotime("02:00 pm"));
                                            $session_5_end_time = date("H:i:s",strtotime("04:00 pm"));
                                            $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                            ?>
                                            <td>
                                                <b>2:00 – 4:00pm</b>
                                            </td>
                                            <td>
                                                Mentorship
                                            </td>
                                            <td>
                                                @if($session_5)
                                                    @foreach($session_5->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="02:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="04:00 PM">
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
                                                            <input id="start_time_session_5" type="text" name="start_time" value="02:00 PM">
                                                            <input id="end_time_session_5" type="text" name="end_time" value="04:00 PM">
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
                                            $session_6_end_time = date("H:i:s",strtotime("04:30 pm"));
                                            $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                            ?>
                                            <td>
                                                <b>4:00 – 4:30pm</b>
                                            </td>
                                            <td>
                                                Kahoot + Closing remarks
                                            </td>
                                            <td>
                                                @if($session_6)
                                                    @foreach($session_5->facilitators as $facilitator)
                                                        {{$facilitator->name}}<br />
                                                    @endforeach
                                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                        <div style="display: none;">
                                                            <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="04:00 PM">
                                                            <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="04:30 PM">
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
                                                            <input id="end_time_session_6" type="text" name="end_time" value="04:30 PM">
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
                                        </tbody>
                                        @endif
                                        @if($category->name == "Virtual Assistant")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:00 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:00 - 9:00 am</b>
                                                </td>
                                                <td>
                                                    assignment review
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="08:00 AM">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="09:00 AM">
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
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:00 AM">
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
                                                $session_2_start_time = date("H:i:s",strtotime("09:05 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("10:00 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>9:05 – 10:00am</b>
                                                </td>
                                                <td>
                                                    review of Upwork. Approval to 100%profile
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="09:05 AM">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="10:00 AM">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:05 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="10:00 AM">
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
                                                $session_3_start_time = date("H:i:s",strtotime("10:00 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("10:45 am"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>10:00 – 10:45am</b>
                                                </td>
                                                <td>
                                                    Link payment methods PayPal, Mpesa,Payoneer to Upwork
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="10:00 AM">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="10:45 AM">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="10:00 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="10:45 AM">
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
                                                $session_4_start_time = date("H:i:s",strtotime("11:00 am"));
                                                $session_4_end_time = date("H:i:s",strtotime("12:00 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:00 - 12:00pm</b>
                                                </td>
                                                <td>
                                                    Bidding
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="11:00 AM">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="11:00 AM">
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
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("12:10 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("01:00 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>12:10 – 1:00pm</b>
                                                </td>
                                                <td>
                                                    Email &canva
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_5->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="12:00 PM">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="01:00 PM">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="12:00 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="01:00 PM">
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
                                                <td class="text-center" colspan="3">
                                                    <b>LUNCH BREAK 1:00 - 1:45 pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_6_start_time = date("H:i:s",strtotime("1:45 pm"));
                                                $session_6_end_time = date("H:i:s",strtotime("2:20 pm"));
                                                $session_6 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_6_start_time)->where("end_time",$session_6_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>1:45 – 2:20pm</b>
                                                </td>
                                                <td>
                                                    blog and file conversion
                                                </td>
                                                <td>
                                                    @if($session_6)
                                                        @foreach($session_6->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="2:20 PM">
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
                                                                <input id="start_time_session_6" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_6" type="text" name="end_time" value="2:20 PM">
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
                                                $session_7_start_time = date("H:i:s",strtotime("2:25 pm"));
                                                $session_7_end_time = date("H:i:s",strtotime("3:00 pm"));
                                                $session_7 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_7_start_time)->where("end_time",$session_7_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>2:25 – 3:00pm</b>
                                                </td>
                                                <td>
                                                    booking flights, Drop Box
                                                </td>
                                                <td>
                                                    @if($session_7)
                                                        @foreach($session_7->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_7->id}}" type="text" name="start_time" value="2:25 PM">
                                                                <input id="end_time_session_{{$session_7->id}}" type="text" name="end_time" value="3:00 PM">
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
                                                                <input id="start_time_session_7" type="text" name="start_time" value="2:25 PM">
                                                                <input id="end_time_session_7" type="text" name="end_time" value="3:00 PM">
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
                                                <?php
                                                $session_8_start_time = date("H:i:s",strtotime("3:25 pm"));
                                                $session_8_end_time = date("H:i:s",strtotime("4:25 pm"));
                                                $session_8 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_8_start_time)->where("end_time",$session_8_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:25 – 4:25pm</b>
                                                </td>
                                                <td>
                                                    Mentorship- Mentor
                                                </td>
                                                <td>
                                                    @if($session_8)
                                                        @foreach($session_8->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_8->id}}" type="text" name="start_time" value="3:25 PM">
                                                                <input id="end_time_session_{{$session_8->id}}" type="text" name="end_time" value="4:25 PM">
                                                            </div>
                                                            <a href="#!" data-toggle="modal" data-session_id="{{$session_8->id}}" id="{{$session_8->id}}"  class="openModalUpdateSessionFacilitators float-right">
                                                                <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                                    <i class="feather icon-plus"></i>
                                                                </button>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_8" type="text" name="start_time" value="3:25 PM">
                                                                <input id="end_time_session_8" type="text" name="end_time" value="4:25 PM">
                                                            </div>
                                                            <a href="#!" data-toggle="modal" id="8"  class="openModalUpdateSessionFacilitators float-right">
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
                                                $session_9_start_time = date("H:i:s",strtotime("4:15 pm"));
                                                $session_9_end_time = date("H:i:s",strtotime("4:30 pm"));
                                                $session_9 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_9_start_time)->where("end_time",$session_9_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:15 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    kahoot
                                                </td>
                                                <td>
                                                    @if($session_9)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_9->id}}" type="text" name="start_time" value="4:15 PM">
                                                                <input id="end_time_session_{{$session_9->id}}" type="text" name="end_time" value="4:30 PM">
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
                                                                <input id="start_time_session_9" type="text" name="start_time" value="4:15 PM">
                                                                <input id="end_time_session_9" type="text" name="end_time" value="4:30 PM">
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
                                        @endif
                                        @if($category->name == "Transcription")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("09:30 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:00 - 9:30am</b>
                                                </td>
                                                <td>
                                                    RECAP OF QA-WORLD SESSIONS (Q&A SESSION)
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="{{$session_one->start_time}}">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="{{$session_one->end_time}}">
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
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:30 AM">
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
                                            {{--                                            <tr>--}}
                                            {{--                                                <td class="text-center" colspan="3">--}}
                                            {{--                                                    <b>Health Break: 09:30 - 09:40 am</b>--}}
                                            {{--                                                </td>--}}
                                            {{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:40 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("10:30 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:40 - 10:30am</b>
                                                </td>
                                                <td>
                                                    SETTING UP  GOTRANSCRIPT
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="{{$session_2->start_time}}">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="{{$session_2->end_time}}">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:40 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="10:30 AM">
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
                                            {{--                                            <tr>--}}
                                            {{--                                                <td class="text-center" colspan="3">--}}
                                            {{--                                                    <b>Health Break: 09:55 - 10:00 am</b>--}}
                                            {{--                                                </td>--}}
                                            {{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("10:30 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("11:20 am"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>10:30 - 11:20am</b>
                                                </td>
                                                <td>
                                                    REVIEWING OF ASSIGNMENT AND SETTING UP  UPWORK
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="{{$session_3->start_time}}">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="{{$session_3->end_time}}">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="10:30 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="11:20 AM">
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
                                                $session_4_start_time = date("H:i:s",strtotime("11:30 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("1:00 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:30 – 1:00pm</b>
                                                </td>
                                                <td>
                                                    BIDDING PROCESS THEORY AND PRACTICAL
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="{{$session_4->start_time}}">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="{{$session_4->end_time}}">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="11:30 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="01:00 PM">
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
                                                    <b>LUNCH BREAK 1:00 - 1:45pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("02:00 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("04:00 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>2:00 – 4:00pm</b>
                                                </td>
                                                <td>
                                                    Q&A and MENTORSHIP
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_5->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="{{$session_5->start_time}}">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="{{$session_5->end_time}}">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="2:00 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="04:00 PM">
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
                                                $session_6_end_time = date("H:i:s",strtotime("04:30 pm"));
                                                $session_6= \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>4:00 – 4:30pm</b>
                                                </td>
                                                <td>
                                                    KAHOOT AND MOTIVATIONAL TALK
                                                </td>
                                                <td>
                                                    @if($session_6)
                                                        @foreach($session_6->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_6->id}}" type="text" name="start_time" value="{{$session_6->start_time}}">
                                                                <input id="end_time_session_{{$session_6->id}}" type="text" name="end_time" value="{{$session_6->end_time}}">
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
                                                                <input id="start_time_session_6" type="text" name="start_time" value="4:00 PM">
                                                                <input id="end_time_session_6" type="text" name="end_time" value="04:30 PM">
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
                                            </tbody>
                                        @endif
                                        @if($category->name == "Digital Marketing/Ecommerce")
                                            <tbody>
                                            <tr>
                                                <?php
                                                $session_one_start_time = date("H:i:s",strtotime("08:00 am"));
                                                $session_one_end_time = date("H:i:s",strtotime("10:00 am"));
                                                $session_one = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_one_start_time)->where("end_time",$session_one_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>8:00 - 10:00am</b>
                                                </td>
                                                <td>
                                                    SEO ,SEM <br />
                                                    Email Marketing
                                                </td>
                                                <td>
                                                    @if($session_one)
                                                        @foreach($session_one->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_one->id}}" type="text" name="start_time" value="{{$session_one->start_time}}">
                                                                <input id="end_time_session_{{$session_one->id}}" type="text" name="end_time" value="{{$session_one->end_time}}">
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
                                                                <input id="end_time_session_1" type="text" name="end_time" value="09:00 AM">
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
                                            {{--                                            <tr>--}}
                                            {{--                                                <td class="text-center" colspan="3">--}}
                                            {{--                                                    <b>Health Break: 09:30 - 09:40 am</b>--}}
                                            {{--                                                </td>--}}
                                            {{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_2_start_time = date("H:i:s",strtotime("09:00 am"));
                                                $session_2_end_time = date("H:i:s",strtotime("11:00 am"));
                                                $session_2 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_2_start_time)->where("end_time",$session_2_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>09:00 - 11:00am</b>
                                                </td>
                                                <td>
                                                    Jobs Available Online <br />
                                                    Overview of the five Job Categories
                                                </td>
                                                <td>
                                                    @if($session_2)
                                                        @foreach($session_2->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_2->id}}" type="text" name="start_time" value="{{$session_2->start_time}}">
                                                                <input id="end_time_session_{{$session_2->id}}" type="text" name="end_time" value="{{$session_2->end_time}}">
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
                                                                <input id="start_time_session_2" type="text" name="start_time" value="09:00 AM">
                                                                <input id="end_time_session_2" type="text" name="end_time" value="11:00 AM">
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
                                            {{--                                            <tr>--}}
                                            {{--                                                <td class="text-center" colspan="3">--}}
                                            {{--                                                    <b>Health Break: 11:00 - 11:10 am</b>--}}
                                            {{--                                                </td>--}}
                                            {{--                                            </tr>--}}
                                            <tr>
                                                <?php
                                                $session_3_start_time = date("H:i:s",strtotime("11:10 am"));
                                                $session_3_end_time = date("H:i:s",strtotime("1:00 pm"));
                                                $session_3 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_3_start_time)->where("end_time",$session_3_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>11:10 - 1:00pm</b>
                                                </td>
                                                <td>
                                                    Opening an Upwork/ Fiverr Account<br />
                                                    Link to payment Method
                                                </td>
                                                <td>
                                                    @if($session_3)
                                                        @foreach($session_3->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_3->id}}" type="text" name="start_time" value="{{$session_3->start_time}}">
                                                                <input id="end_time_session_{{$session_3->id}}" type="text" name="end_time" value="{{$session_3->end_time}}">
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
                                                                <input id="start_time_session_3" type="text" name="start_time" value="11:10 AM">
                                                                <input id="end_time_session_3" type="text" name="end_time" value="1:00 PM">
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
                                                    <b>LUNCH BREAK 1:00 - 2:00pm</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $session_4_start_time = date("H:i:s",strtotime("1:45 pm"));
                                                $session_4_end_time = date("H:i:s",strtotime("3:15 pm"));
                                                $session_4 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_4_start_time)->where("end_time",$session_4_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>1:45 – 3:15pm</b>
                                                </td>
                                                <td>
                                                    Social Media Marketing(SMM)<br />
                                                    Youtube Marketing
                                                </td>
                                                <td>
                                                    @if($session_4)
                                                        @foreach($session_4->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_4->id}}" type="text" name="start_time" value="{{$session_4->start_time}}">
                                                                <input id="end_time_session_{{$session_4->id}}" type="text" name="end_time" value="{{$session_4->end_time}}">
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
                                                                <input id="start_time_session_4" type="text" name="start_time" value="1:45 PM">
                                                                <input id="end_time_session_4" type="text" name="end_time" value="3:15 PM">
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
                                                <?php
                                                $session_5_start_time = date("H:i:s",strtotime("3:20 pm"));
                                                $session_5_end_time = date("H:i:s",strtotime("04:20 pm"));
                                                $session_5 = \App\Models\Session::where("day_id",$trainingDay->id)->where("start_time",$session_5_start_time)->where("end_time",$session_5_end_time)->first();
                                                ?>
                                                <td>
                                                    <b>3:20 – 4:20pm</b>
                                                </td>
                                                <td>
                                                    Ecommerce
                                                </td>
                                                <td>
                                                    @if($session_5)
                                                        @foreach($session_9->facilitators as $facilitator)
                                                            {{$facilitator->name}}<br />
                                                        @endforeach
                                                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                                                            <div style="display: none;">
                                                                <input id="start_time_session_{{$session_5->id}}" type="text" name="start_time" value="{{$session_5->start_time}}">
                                                                <input id="end_time_session_{{$session_5->id}}" type="text" name="end_time" value="{{$session_5->end_time}}">
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
                                                                <input id="start_time_session_5" type="text" name="start_time" value="03:20 PM">
                                                                <input id="end_time_session_5" type="text" name="end_time" value="04:20 PM">
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
                                        @endif
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
@endsection
