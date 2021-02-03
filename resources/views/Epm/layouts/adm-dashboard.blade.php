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
    $sessions = \App\Models\TrainingSession::all();
    $trainees = \App\Models\Trainee::all();

    ?>
    <div class="col-md-12">
        <h2 class="font-weight-normal">Hi {{$auth_admin->name}}, Welcome back!</h2>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between mb-4">
                            <div class="col-auto">
                                <h2 class="font-weight-normal mb-0">Project Managers</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="pmsOverview"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-4 border rounded">
                                    @if($pms)
                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($pms)}}</h1>
                                    @endif
                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>
{{--                                    <p class="text-uppercase">TRAINEES</p>--}}
                                    <div class="rounded bg-light p-3">
                                        <div class="media align-items-center">
                                            <i class="feather icon-alert-circle h2 mb-0"></i>
                                            <div class="media-body ml-3">
                                                Operations is the Department with the most PMOs
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-4">
                            <div class="col-auto">
                                <h2 class="font-weight-normal mb-0">Trainers</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="trainersOverview"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-4 border rounded">
                                    @if($trainers)
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
                        <div class="row align-items-center justify-content-between mb-4">
                            <div class="col-auto">
                                <h2 class="font-weight-normal mb-0">Sessions</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="sessionsOverview"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-4 border rounded">
                                    @if($sessions)
                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($sessions)}}</h1>
                                    @endif
                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>
                                    {{--                                    <p class="text-uppercase">TRAINEES</p>--}}
                                    <div class="rounded bg-light p-3">
                                        <div class="media align-items-center">
                                            <i class="feather icon-alert-circle h2 mb-0"></i>
                                            <div class="media-body ml-3">
                                                Operations is the Category with the most Sessions Trained
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-between mb-4">
                            <div class="col-auto">
                                <h2 class="font-weight-normal mb-0">Trainees</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="traineesOverview"></div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-4 border rounded">
                                    @if($trainees)
                                        <h1 class="display-4 d-inline-block font-weight-normal">{{count($trainees)}}</h1>
                                    @endif
                                    <p class="text-danger d-inline-block mb-0">4.9%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>
                                    {{--                                    <p class="text-uppercase">TRAINEES</p>--}}
                                    <div class="rounded bg-light p-3">
                                        <div class="media align-items-center">
                                            <i class="feather icon-alert-circle h2 mb-0"></i>
                                            <div class="media-body ml-3">
                                                February was the month with the most Trainees registered
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        // $(function() {
        //     var options = {
        //         chart: {
        //             height: 220,
        //             type: 'bar',
        //         },
        //         series: [],
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         title:{
        //             text: 'Project Managers Overview'
        //         },
        //         noData:{
        //             text: 'Loading ...'
        //         },
        //     }
        //     var chart = new ApexCharts(document.querySelector("#pmsOverview"), options);
        //     chart.render();
        //     var url = 'http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly';
        //
        //     axios({
        //         method: 'GET',
        //         url: url,
        //     }).then(function(response) {
        //         chart.updateSeries([{
        //             name: 'Sales',
        //             data: response.data
        //         }])
        //     })
        // });

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
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [{
                    name: 'PMOs',
                    data: [10, 13, 9, 15, 19,10,8,14]
                }],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Project Managers Overview'
                },
                xaxis: {
                    categories: [
                        'Training', 'M & E', 'Ajira Youth Empowerment', 'Centers (AYECs)', 'Operations','Mentorship',
                        'Ajira Clubs','Project Management Office (PMO)'
                    ],
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
                    show: true,
                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#pmsOverview"), options);
            chart.render();
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
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800', '#d7dfe9'],
                series: [{
                    name: 'Male',
                    data: [100, 130, 103, 125, 90]
                }, {
                    name: 'Female',
                    data: [99, 132, 70, 89, 105]
                }],
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
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
                    show: true,
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
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800', '#d7dfe9'],
                series: [ {
                    name: 'Trainers',
                    data: [99, 132, 70, 89, 105]
                }],
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ['Data Management', 'Digital Marketing', 'Transcription', 'Content Writing', 'Virtual Assistant'],
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
                    show: true,
                },
                legend: {
                    show: true,
                },
                fill: {
                    opacity: 1
                },
            }
            var chart = new ApexCharts(document.querySelector("#trainersOverview"), options);
            chart.render();
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
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [{
                    name: 'Sessions',
                    data: [10, 13, 9, 15, 19]
                }],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Sessions Overview'
                },
                xaxis: {
                    categories: ['Data Management', 'Digital Marketing', 'Transcription', 'Content Writing', 'Virtual Assistant'],
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
                    show: true,
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
                        columnWidth: '50%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800'],
                series: [ {
                    name: 'Trainees',
                    data: [99, 132, 70, 89, 105]
                }],
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'March', 'April', 'March'],
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
                    show: true,
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
            var chart = new ApexCharts(document.querySelector("#taskfull-dashboard-chart1"), options);
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
                colors: ['#FFB800'],
                fill: {
                    type: 'solid',
                },
                series: [65],
                labels: ['open tasks'],
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
                colors: ['#ff0b37'],
                fill: {
                    type: 'solid',
                },
                series: [65],
                labels: ['overdue tasks'],
            }
            var chart = new ApexCharts(document.querySelector("#opentask-taskchart2"), options);
            chart.render();
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

