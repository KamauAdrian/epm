@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/daterangepicker.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    $pm_role = \App\Models\Role::where('name','Project Manager')->first();
    $cm_role = \App\Models\Role::where('name','Center Manager')->first();
    $trainer_role = \App\Models\Role::where('name','Trainer')->first();
    $mentor_role = \App\Models\Role::where('name','Mentor')->first();
    if ($pm_role){
        $pms = \App\Models\User::where('role_id',$pm_role->id)->get();
    }
    if ($cm_role){
        $cms = \App\Models\User::where('role_id',$cm_role->id)->get();
    }

    if ($trainer_role){
        $trainers = \App\Models\User::where('role_id',$trainer_role->id)->get();
    }
    if ($mentor_role){
        $mentors = \App\Models\User::where('role_id',$mentor_role->id)->get();
    }
    $centers = \App\Models\Center::all();
    $sessions = \App\Models\TrainingSession::all();
    $trainees = \App\Models\Trainee::all();
    $projects = \App\Models\Project::all();

    ?>
    <div class="col-md-12">
        <h2 class="font-weight-normal text-center">Hi {{$auth_admin->name}}, Welcome to eMobilis Portal</h2>
    </div>
    <div class="col-md-12">
        <p>Our Mission</p>
        <p>The mission of eMobilis is to create opportunities for African youth by training them on digital, software and other technologies that prepare them for the future of work by equipping them with marketable, industry driven skills.</p>
    </div>
    <div class="col-md-12">
        <p>Our Vision</p>
        <p>Our vision is to empower local youth to tap into the myriad opportunities that the mobile, technology and software development industry offers so that they can innovate, create and improve their situation in life through use of digital tools.</p>
    </div>
{{--    ///////// rem copied data to sample page--}}
    <div class="col-md-12">
        <div class="row">
{{--            //pmo--}}
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">PMO</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    @if($pm_role)
                                    <span style="font-size:30px">
                                        <p class="text-center "><span class="float-left ml-4">{{count($pms)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @else
                                        <span style="font-size:30px">
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            //center Manger--}}
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Center Managers</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="font-size:30px">
                                    @if($cm_role)
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($cms)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @else
                                        <span>
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            //trainers--}}
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Trainers</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="font-size:30px">
                                    @if($trainer_role)
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($trainers)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @else
                                        <span>
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            //Work Streams--}}

                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Work Streams</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="font-size:30px">
                                    @if($projects)
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($projects)}}</span> <i class="fa fa-briefcase ml-4"></i></p>
                                    </span>
                                    @else
                                        <span>
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-briefcase ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            //Centers--}}
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Centers</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="font-size:30px">
                                    @if($centers)
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($centers)}}</span> <i class="fa fa-building ml-4"></i></p>
                                    </span>
                                    @else
                                        <span>
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-building ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--            //Trainees--}}
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">Trainees</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div style="font-size:30px">
                                    @if($trainees)
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($trainees)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @else
                                        <span>
                                        <p class="text-center "><span class="float-left ml-4">0</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

{{--    ///////// rem copied data to sample page--}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="openTasks"></div>
{{--                                <h5 class="text-success">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>--}}
                                <h5 class="text-info">Open Tasks</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="overDueTasks"></div>
{{--                                <h5 class="text-danger">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>--}}
                                <h5 class="text-danger">Overdue Tasks</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="completeTasks"></div>
                                <h5 class="text-success">Complete Tasks</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="inCompleteTasks"></div>
                                <h5 class="text-primary">Incomplete Tasks</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-normal">Tasks by Work Streams</h3>
                        <div id="workStreamsTaskOverview" class="mb-4 mt-5"></div>
                        @if($projects)
                            <div>
                                @foreach($projects as $project)
                                    <p class="mb-3">{{$project->name}} <span class="float-right h6 mb-0 text-body">{{count($project->tasks)}}</span></p>
                                @endforeach
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-green f-10 m-r-10"></i>You have 2 pending requests.. <span class="float-right h6 mb-0 text-body">7</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 3 pending tasks <span class="float-right h6 mb-0 text-body">4</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-yellow f-10 m-r-10"></i>New order received <span class="float-right h6 mb-0 text-body">6</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-purple f-10 m-r-10"></i>Incoming requests <span class="float-right h6 mb-0 text-body">28</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 4 pending tasks <span class="float-right h6 mb-0 text-body">9</span></p>--}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="col-md-12">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        //project managers--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 mb-4 align-items-center justify-content-between">--}}
{{--                                <h2 class="font-weight-normal mb-0">PMO</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="pmsOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($pm_role)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($pms)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                Operations is the Department with the most PMOs--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                            //Centers--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Center Manager')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 mb-4 align-items-center justify-content-between">--}}
{{--                                <h2 class="font-weight-normal mb-0">Center Managers</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="cmsOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($cm_role)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($cms)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    --}}{{----}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                Operations is the Department with the most PMOs--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                            //center Managers--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Center Manager')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 mb-4 align-items-center justify-content-between">--}}
{{--                                <h2 class="font-weight-normal mb-0">Centers</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="centersOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($centers)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($centers)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    --}}{{----}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                Operations is the Department with the most PMOs--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                            //Trainers--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Trainer')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 align-items-center justify-content-between mb-4">--}}
{{--                                <h2 class="font-weight-normal mb-0">Trainers</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="trainersOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($trainer_role)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($trainers)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                Digital Marketing is the category with the most Trainers--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                            //sessions--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Trainer')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 align-items-center justify-content-between mb-4">--}}
{{--                                <h2 class="font-weight-normal mb-0">Sessions</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="sessionsOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($sessions)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($sessions)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    --}}{{----}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                Operations is the Category with the most Sessions Trained--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                            //Trainees--}}
{{--                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Trainer')--}}
{{--                            <div class="row">--}}
{{--                            <div class="col-sm-12 align-items-center justify-content-between mb-4">--}}
{{--                                <h2 class="font-weight-normal mb-0">Trainees</h2>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div id="traineesOverview"></div>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <div class="p-4 border rounded">--}}
{{--                                    @if($trainees)--}}
{{--                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($trainees)}}</h1>--}}
{{--                                    @endif--}}
{{--                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                                    --}}{{----}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
{{--                                    <div class="rounded bg-light p-3">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <i class="feather icon-alert-circle h2 mb-0"></i>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                February was the month with the most Trainees registered--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--//best performer--}}
    <div class="col-md-12">
        <div class="row">
{{--            @foreach($best_performers as $best_performer)--}}
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h5>Award Title</h5>
                        </div>
                        <div class="card-body">

                            <figure class="figure"><img src="{{url('assets/images/user.png')}}" alt="" style="height: 150px;width: 150px;"></figure>
                            <p>Best Performer name</p>
                        </div>
                    </div>
                </div>
{{--            @endforeach--}}
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
{{--            @foreach($announcements as $announcement)--}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <a href="#!"><h5>Announcement Title</h5></a>
                        </div>
                        <div class="card-body">
                            <figure class="figure"><img src="{{url('assets/images/user.png')}}" alt="" style="height: 150px;width: 150px;"></figure>
                            <p>Short Desc Date</p>
                        </div>
                    </div>
                </div>
{{--            @endforeach--}}
        </div>
    </div>
@endsection
@section('js')
    <!-- Required Js -->
    <script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    <script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
    <script>
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '22px'
                            }
                        }
                    }
                },
                colors: ['#00ACC1'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Open'],
            }
            var chart = new ApexCharts(document.querySelector("#openTasks"), options);
            chart.render();
            axios.get('/adm/get/open/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '22px'
                            }
                        }
                    }
                },
                colors: ['#FF0B37'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Overdue'],
            }
            var chart = new ApexCharts(document.querySelector("#overDueTasks"), options);
            chart.render();
            axios.get('/adm/get/overdue/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '22px'
                            }
                        }
                    }
                },
                colors: ['#2DCA73'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Complete'],
            }
            var chart = new ApexCharts(document.querySelector("#completeTasks"), options);
            chart.render();
            axios.get('/adm/get/complete/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    },
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#D7DFE9",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            shadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            value: {
                                offsetY: -40,
                                fontSize: '22px'
                            }
                        }
                    }
                },
                colors: ['#0B69FF'],
                fill: {
                    type: 'solid',
                },
                series: [],
                labels: ['Incomplete'],
            }
            var chart = new ApexCharts(document.querySelector("#inCompleteTasks"), options);
            chart.render();
            axios.get('/adm/get/incomplete/tasks').then(function(response) {
                console.log(response.data);
                chart.updateSeries([response.data]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    height: 200,
                    type: 'donut',
                    sparkline: {
                        enabled: true
                    },
                },
                series: [],
                labels: [],
                colors: ["#FFB800"],
                legend: {
                    show: false,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '85%',
                            labels: {
                                show: true,
                                name: {
                                    show: false
                                },
                                value: {
                                    show: true
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
            }
            var chart = new ApexCharts(document.querySelector("#workStreamsTaskOverview"), options);
            chart.render();
            // axios.get('/adm/list/projects').then(function(response) {
            //     console.log(response.data.length);
            //     var updateData = response.data;
            //     updateData.forEach(function (data){
            //         var pName = [];
            //         var pTasks = [];
            //         pName=[data.name];
            //         pTasks=[data.tasks];
            //         console.log(pName);
            //         chart.updateOptions({
            //             labels:pName,
            //             series:pTasks,
            //         });
            //     });
            // });

            axios.get('/adm/list/projects').then(function(response) {
                chart.updateOptions({
                    labels:response.data,
                });
            });
            axios.get('/adm/get/project/tasks').then(function(response) {
                chart.updateOptions({
                    series: response.data,
                });
                // chart.updateSeries([
                //     response.data
                // ]);
            });
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Overview'
                },
                noData:{
                    text: 'Loading ...'
                },xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    axisBorder:{
                        show: false,
                    },
                    show: false,
                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                }
            }
            var chart = new ApexCharts(document.querySelector("#pmsOverview"), options);
            chart.render();

            axios.get('/adm/get/pms/records').then(function(response) {
                chart.updateSeries([{
                    name: 'PMOs',
                    data: response.data
                }]);
            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                noData: {
                    text: 'Loading ...'
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#centersOverview"), options);
            chart.render();
            axios.get('/adm/get/centers/records/').then(function(response) {
                chart.updateSeries([{
                    name: 'Center Managers',
                    data: response.data
                }])
            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 220,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                noData: {
                  text: 'Loading ...'
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: true,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#cmsOverview"), options);
            chart.render();
            axios.get('/adm/get/cms/records/').then(function(response) {
                chart.updateSeries([{
                    name: 'Center Managers',
                    data: response.data
                }])
            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'line',
                    stacked: false,
                    toolbar: {
                        show: false,
                    }
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Overview'
                },
                noData: {
                    text: 'Loading ...'
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#trainersOverview"), options);
            chart.render();
            axios.get('/adm/get/trainers/records').then(function(response) {
                chart.updateSeries([{
                    name: 'Trainers',
                    data: response.data
                }])
            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Overview'
                },
                noData: {
                  text: 'Loading ...'
                },
                xaxis: {axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#sessionsOverview"), options);
            chart.render();
            axios.get('/adm/get/sessions/records').then(function(response) {
                chart.updateSeries([{
                    name: 'Sessions',
                    data: response.data
                }])
            })
        });
        $(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                    stacked: false,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        vertical: true,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Overview'
                },
                noData: {
                    text: 'Loading ...'
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                },
                yaxis: {
                    show: false,
                },
                legend: {
                    show: true,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#traineesOverview"), options);
            chart.render();
            axios.get('/adm/get/trainees/records').then(function(response) {
                chart.updateSeries([{
                    name: 'Trainees',
                    data: response.data
                }])
            })
        });
        $(function() {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#dashboarddatepicker1 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#dashboarddatepicker1').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
    </script>
@endsection

