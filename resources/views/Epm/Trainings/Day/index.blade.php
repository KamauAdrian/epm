@extends("Epm.layouts.master")

@section("content")
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Training Day {{$trainingDay->day}}</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                {{--                @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")--}}
                {{--                    <a href="{{url("/adm/".$auth_admin->id."/edit/training/".$training->id."/day/".$trainingDay->id)}}">--}}
                {{--                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Edit</button>--}}
                {{--                    </a>--}}
                {{--                @endif--}}
                {{--                <a href="#!">--}}
                {{--                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>--}}
                {{--                </a>--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-12 text-center">
                            <h5>Training Sessions Allocation</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Time</th>
                                    <th>Session</th>
                                    <th>Facilitators</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
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
                                        Adrian <br /> Claire <br /> Laureen
                                        <a href="{{url("/adm/".$auth_admin->id."/edit/training/".$trainingDay->training_id."/day/".$trainingDay->day."/".$trainingDay->id."/session/1")}}" class="float-right">
                                            <button type="button" title="Add Session Facilitator" class="btn btn-icon icon-s">
                                                <i class="feather icon-plus"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
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
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><b>8:45-9:00</b><br />
                                        (Duration: 15 minutes)
                                    </td>
                                    <td><b>Opening Ceremony</b><br />
                                        <b>Remarks:</b> Ministry of ICT<br />
                                        Madam Zilpher Owiti
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
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
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td class="text-center" colspan="2">
                                        <b>Health Break: 10:00 am-10:15 am (15 minutes)</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
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
                                </tr>
                                <tr>
                                    <td>7</td>
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
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td class="text-center" colspan="2">
                                        <b>LUNCH BREAK 12:00-1:00 pm (1 hour)</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
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
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
