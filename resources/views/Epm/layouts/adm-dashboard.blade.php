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
                                                Friday was the day with the most Trainees registered
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
                                                Friday was the day with the most Trainees registered
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
{{--    <div class="col-lg-8">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <div id="opentask-taskchart1"></div>--}}
{{--                        <h5 class="text-success">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-sm-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <div id="opentask-taskchart2"></div>--}}
{{--                        <h5 class="text-danger">10.5%<i class="mr-2 ml-1 feather icon-arrow-up"></i><small class="text-body">Since last week</small></h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h2 class="font-weight-normal mb-4">Tasks by Team</h2>--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div id="taskfull-dashboard-chart1" class="my-2"></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-8">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-blue f-10 m-r-10"></i>Engineering <span class="float-right h6 mb-0 text-body">11</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-green f-10 m-r-10"></i>Creative <span class="float-right h6 mb-0 text-body">7</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>Finance <span class="float-right h6 mb-0 text-body">4</span></p>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-yellow f-10 m-r-10"></i>Marketing <span class="float-right h6 mb-0 text-body">6</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-purple f-10 m-r-10"></i>Product design <span class="float-right h6 mb-0 text-body">28</span></p>--}}
{{--                                <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>User research <span class="float-right h6 mb-0 text-body">9</span></p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr class="my-4">--}}
{{--                <div class="row align-items-center justify-content-between mb-4">--}}
{{--                    <div class="col-auto">--}}
{{--                        <h2 class="font-weight-normal mb-0">Weekly Variation</h2>--}}
{{--                    </div>--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="row justify-content-end d-none d-sm-flex">--}}
{{--                            <div class="col-auto">--}}
{{--                                <span class=""><i class="fas fa-circle text-danger f-10 m-r-5"></i>Overdue</span>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto">--}}
{{--                                <span class=""><i class="fas fa-circle text-warning f-10 m-r-5"></i>Open</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">Creative</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-success d-inline-block mb-0">1.9%<i class="mr-2 ml-1 feather icon-arrow-up"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">Engineering</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-success d-inline-block mb-0">1.9%<i class="mr-2 ml-1 feather icon-arrow-up"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">Finance</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-success d-inline-block mb-0">1.9%<i class="mr-2 ml-1 feather icon-arrow-up"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">Marketing</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-danger d-inline-block mb-0">9.3%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">product design</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-success d-inline-block mb-0">1.9%<i class="mr-2 ml-1 feather icon-arrow-up"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6 mb-3">--}}
{{--                        <h6 class="text-body text-uppercase">uwer research</h6>--}}
{{--                        <div class="progress my-2">--}}
{{--                            <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"></div>--}}
{{--                            <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"></div>--}}
{{--                        </div>--}}
{{--                        <p class="text-danger d-inline-block mb-0">9.3%<i class="mr-2 ml-1 feather icon-arrow-down"></i></p>--}}
{{--                        <p class="d-inline-block">Last 7 days</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr class="my-4">--}}
{{--                <div class="text-center">--}}
{{--                    <a href="#!" class="text-body">See all</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-lg-4">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <h3 class="font-weight-normal">Tasks by Project</h3>--}}
{{--                <div id="taskfull-dashboard-chart2" class="mb-4 mt-5"></div>--}}
{{--                <div>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-blue f-10 m-r-10"></i>Incoming requests <span class="float-right h6 mb-0 text-body">11</span></p>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-green f-10 m-r-10"></i>You have 2 pending requests.. <span class="float-right h6 mb-0 text-body">7</span></p>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 3 pending tasks <span class="float-right h6 mb-0 text-body">4</span></p>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-yellow f-10 m-r-10"></i>New order received <span class="float-right h6 mb-0 text-body">6</span></p>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-purple f-10 m-r-10"></i>Incoming requests <span class="float-right h6 mb-0 text-body">28</span></p>--}}
{{--                    <p class="mb-3"><i class="fas fa-circle text-c-red f-10 m-r-10"></i>You have 4 pending tasks <span class="float-right h6 mb-0 text-body">9</span></p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <h3 class="mb-4">MY Activity</h3>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-2.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 3 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Created task <span class="text-primary">Nulla vitae elit libero a pharetra.</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-3.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 5 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Completed task <span class="text-primary">Cantapibus dolor at ace</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-1.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 6 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Invite <span class="text-primary">Ashoka T.</span> to <span class="text-primary">Revamp Design System</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-2.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 8 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Created task <span class="text-primary">Nulla vitae elit libero a pharetra.</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-3.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 10 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Completed task <span class="text-primary">Cantapibus dolor at ace</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="media align-items-center mb-4">--}}
{{--            <img src="assets/images/user/avatar-1.jpg" alt="images" class="img-fluid avtar avtar-xs">--}}
{{--            <div class="media-body ml-3 align-self-center">--}}
{{--                <h6 class="mb-0 d-inline-block">Luke S. </h6>--}}
{{--                <p class="mb-0 d-inline-block"> 12 min ago</p>--}}
{{--                <p class="mt-1 mb-0">Invite <span class="text-primary">Ashoka T.</span> to <span class="text-primary">Revamp Design System</span></p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class="text-center">--}}
{{--            <a href="#!" class="text-body">See all</a>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('js')
    <!-- Required Js -->
    <script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    <script src="{{url('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/daterangepicker.js')}}"></script>
    <script>
        $(function() {
            $(function() {
                var start = moment().subtract(29, 'days');
                var end = moment();

                function cb(start, end) {
                    $('#dashboardtaskreportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                $('#dashboardtaskreportrange2').daterangepicker({
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
        });
        $(function() {
            var options = {
                chart: {
                    height: 220,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#2DCA73', '#d7dfe9'],
                series: [{
                    name: 'PRODUCT A',
                    data: [10, 12, 15, 10, 8]
                }, {
                    name: 'PRODUCT B',
                    data: [18, 16, 13, 18, 20]
                }],
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ['MON', 'Tue', 'Wed', 'Thu', 'Fri'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: false,
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
            var chart = new ApexCharts(document.querySelector("#dashboardtastbar6"), options);
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 220,
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                colors: ['#FFB800', '#d7dfe9'],
                series: [{
                    name: 'PRODUCT A',
                    data: [8, 10, 12, 15, 10]
                }, {
                    name: 'PRODUCT B',
                    data: [20, 18, 16, 13, 18]
                }],
                dataLabels: {
                    enabled: false,
                },
                xaxis: {
                    categories: ['MON', 'Tue', 'Wed', 'Thu', 'Fri'],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                grid: {
                    show: false,
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
            var chart = new ApexCharts(document.querySelector("#dashboardtastbar5"), options);
            chart.render();
        });
        $(function() {
            var options = {
                chart: {
                    height: 220,
                    type: 'bar',
                },
                series: [],
                dataLabels: {
                    enabled: false,
                },
                title:{
                    text: 'Project Managers Overview'
                },
                noData:{
                    text: 'Loading ...'
                },
            }
            var chart = new ApexCharts(document.querySelector("#pmsOverview"), options);
            chart.render();
            var url = 'http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly';

            axios({
                method: 'GET',
                url: url,
            }).then(function(response) {
                chart.updateSeries([{
                    name: 'Sales',
                    data: response.data
                }])
            })
        });

        // $(function() {
        //     var options = {
        //         chart: {
        //             height: 220,
        //             type: 'bar',
        //             stacked: false,
        //             toolbar: {
        //                 show: false,
        //             }
        //         },
        //         plotOptions: {
        //             bar: {
        //                 vertical: true,
        //                 columnWidth: '50%',
        //                 endingShape: 'rounded'
        //             },
        //         },
        //         colors: ['#FFB800'],
        //         series: [{
        //             name: 'PMOs',
        //             data: [10, 13, 9, 15, 19,10,8,14]
        //         }],
        //         dataLabels: {
        //             enabled: false,
        //         },
        //         title:{
        //             text: 'Project Managers Overview'
        //         },
        //         xaxis: {
        //             categories: [
        //                 'Training', 'M & E', 'Ajira Youth Empowerment', 'Centers (AYECs)', 'Operations','Mentorship',
        //                 'Ajira Clubs','Project Management Office (PMO)'
        //             ],
        //             axisBorder: {
        //                 show: false,
        //             },
        //             axisTicks: {
        //                 show: false,
        //             }
        //         },
        //         grid: {
        //             show: true,
        //         },
        //         yaxis: {
        //             show: true,
        //         },
        //         legend: {
        //             show: false,
        //         },
        //         fill: {
        //             opacity: 1
        //         },
        //     }
        //     var chart = new ApexCharts(document.querySelector("#pmsOverview"), options);
        //     chart.render();
        // });
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
            var chart = new ApexCharts(document.querySelector("#trainersOverview"), options);
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

