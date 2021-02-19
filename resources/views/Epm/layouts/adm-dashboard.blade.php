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

    ?>
    <div class="col-md-12">
        <h2 class="font-weight-normal">Hi {{$auth_admin->name}}, Welcome back!</h2>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            <h5 class="card-title">PMO</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div>
                                    <span style="font-size:30px">
                                        <p class="text-center "><span class="float-left ml-4">{{count($pms)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title">Center Managers</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="font-size:30px">
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($cms)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title">Trainers</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="font-size:30px">
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($trainers)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title">Work Streams</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="font-size:30px">
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($pms)}}</span> <i class="fa fa-briefcase ml-4"></i></p>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title">Centers</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="font-size:30px">
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($centers)}}</span> <i class="fa fa-building ml-4"></i></p>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title">Trainees</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="font-size:30px">
                                    <span>
                                        <p class="text-center "><span class="float-left ml-4">{{count($trainees)}}</span> <i class="fa fa-user ml-4"></i></p>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart1"></div>
                                <h5 class="text-success">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart2"></div>
                                <h5 class="text-danger">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart3"></div>
                                <h5 class="text-success">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <div id="opentask-taskchart4"></div>
                                <h5 class="text-danger">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-normal">Tasks by Project</h3>
                        <div id="taskfull-dashboard-chart2" class="mb-4 mt-5"></div>
                        <div>
                            <p class="mb-3"><i class="fas fa-circle text-c-blue f-10 m-r-10"></i>Incoming requests <span class="float-right h6 mb-0 text-body">11</span></p>
                            <p class="mb-3"><i class="fas fa-circle text-c-green f-10 m-r-10"></i>You have 2 pending requests.. <span class="float-right h6 mb-0 text-body">7</span></p>
                            <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 3 pending tasks <span class="float-right h6 mb-0 text-body">4</span></p>
                            <p class="mb-3"><i class="fas fa-circle text-c-yellow f-10 m-r-10"></i>New order received <span class="float-right h6 mb-0 text-body">6</span></p>
                            <p class="mb-3"><i class="fas fa-circle text-c-purple f-10 m-r-10"></i>Incoming requests <span class="float-right h6 mb-0 text-body">28</span></p>
                            <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 4 pending tasks <span class="float-right h6 mb-0 text-body">9</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
{{--                                    --}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
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
{{--                                    --}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
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
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Trainer')
                            <div class="row">
                            <div class="col-sm-12 align-items-center justify-content-between mb-4">
                                <h2 class="font-weight-normal mb-0">Trainers</h2>
                            </div>
                            <div class="col-sm-6">
                                <div id="trainersOverview"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-4 border rounded">
                                    @if($trainer_role)
                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($trainers)}}</h1>
                                    @endif
                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>
{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
                                    <div class="rounded bg-light p-3">
                                        <div class="media align-items-center">
                                            <i class="feather icon-alert-circle h2 mb-0"></i>
                                            <div class="media-body ml-3">
                                                Digital Marketing is the category with the most Trainers
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
{{--                                    --}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
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
{{--                                    --}}{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
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
                    </div>
                </div>
            </div>
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
                colors: ['#FFB800'],
                fill: {
                    type: 'solid',
                },
                series: [65],
                labels: ['Open'],
            }
            var chart = new ApexCharts(document.querySelector("#opentask-taskchart1"), options);
            chart.render();
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
                colors: ['#FF0000'],
                fill: {
                    type: 'solid',
                },
                series: [65],
                labels: ['Overdue'],
            }
            var chart = new ApexCharts(document.querySelector("#opentask-taskchart2"), options);
            chart.render();
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
                colors: ['#00FF00'],
                fill: {
                    type: 'solid',
                },
                series: [65],
                labels: ['Complete'],
            }
            var chart = new ApexCharts(document.querySelector("#opentask-taskchart3"), options);
            chart.render();
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
                colors: ['#0000FF'],
                fill: {
                    type: 'solid',
                },
                series: [10],
                labels: ['Incomplete'],
            }
            var chart = new ApexCharts(document.querySelector("#opentask-taskchart4"), options);
            chart.render();
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
                series: [44, 55, 41, 17, 15],
                colors: ["#4680ff", "#0e9e4a", "#00acc1", "#ffa21d", "#ff5252"],
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
                                    show: true
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
            var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart2"), options);
            chart.render();
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

