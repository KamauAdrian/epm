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
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url('assets/images/eMobilis-E-shot-2.jpg')}}" style="width: 100%" alt="eMobilis">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><b>Our Mission</b></p>
                                    <p>The mission of eMobilis is to create opportunities for African youth by training them on digital, software and other technologies that prepare them for the future of work by equipping them with marketable, industry driven skills.</p>
                                </div>
                                <div class="col-md-12">
                                    <p><b>Our Vision</b></p>
                                    <p>Our vision is to empower local youth to tap into the myriad opportunities that the mobile, technology and software development industry offers so that they can innovate, create and improve their situation in life through use of digital tools.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    ///////// rem copied data to sample page--}}
    <div class="col-md-12">
        <ddiv class="card">
            <div class="card-header">
                <h5>Overview</h5>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")
                        <div class="row">
                            {{--            //pmo--}}
                            <div class="col-md-4">
                                <div class="card" style="width: 100%;">
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
                            {{--            //center Manager--}}
                            <div class="col-md-4">
                                <div class="card" style="width: 100%;">
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
                                <div class="card" style="width: 100%;">
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
                                <div class="card" style="width: 100%;">
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
                                <div class="card" style="width: 100%;">
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
                                <div class="card" style="width: 100%;">
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
                    @endif

                    @if($auth_admin->role->name == "Center Manager")
                        <div class="row">
                            {{--            //center Manager--}}
                            <div class="col-md-6">
                                <div class="card" style="width: 100%">
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
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
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
                            {{--            //Centers--}}
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
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
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
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
                    @endif

                    @if($auth_admin->role->name == "Trainer")
                        <div class="row">
                            {{--            //trainers--}}
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
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
                            {{--            //Trainees--}}
                            <div class="col-md-6">
                                <div class="card" style="width: 100%;">
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
                    @endif
                </div>
            </div>
        </ddiv>
    </div>

{{--    ///////// rem copied data to sample page--}}
    @if($auth_admin->role->name =="Su Admin" || $auth_admin->role->name =="Project Manager")
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tasks</h5>
                </div>
                <div class="card-body">
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
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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
    <div class="col-md-12" id="awards">
        <div class="card">
            <div class="card-header">
                <h5>Awards</h5>
                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/award')}}" class="btn btn-outline-info float-right">Create Award</a>
            </div>
            <?php
            $awards = \App\Models\Award::orderBy('created_at','desc')->limit(6)->get();
            ?>
            @if($awards)
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($awards as $award)
                                <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header pb-0 mb-2">
                                                {{$award->name}}
                                            </div>
                                            <?php
                                            $winner_position_one = \App\Models\User::find($award->position_one);
                                            $image = '';
                                            $profile_image = $winner_position_one->image;
                                            if ($profile_image==null){
                                                $gender = $winner_position_one->gender;
                                                if ($gender=="Male"){
                                                    $image = 'assets/images/male.jpeg';
                                                }else{
                                                    $image = 'assets/images/female.jpeg';
                                                }
                                            }else{
                                                $role = $winner_position_one->role->name;
                                                if ($role=="Center Manager"){
                                                    $image = "CenterManagers/images/".$profile_image;
                                                }
                                                if ($role=="Project Manager"){
                                                    $image = "ProjectManagers/images/".$profile_image;
                                                }
                                            }
                                            ?>
                                            <div class="card-body text-center">
                                                <div class="d-inline-flex align-items-end justify-content-end">
                                                    <img src="{{url($image)}}" alt="images" class="img-fluid avtar avtar-xl">
                                                </div>
                                                <h5 class="mt-4">{{$winner_position_one->name}}</h5>
                                                <p>Position One</p>
                                                <div class="btn-group">
{{--                                                    <button type="button" class="btn btn-outline-info rounded border mr-3">Send Message</button>--}}
                                                    <a href="{{url("adm/view/adm/".$winner_position_one->id."/profile/role_id=".$winner_position_one->role_id)}}"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>
{{--                                                    <a href="#!"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
{{--                                   @if($award->position_two)--}}
{{--                                       <div class="col-md-4">--}}
{{--                                           <div class="card">--}}
{{--                                               <div class="card-header pb-0 mb-2">--}}
{{--                                                   {{$award->name}}--}}
{{--                                               </div>--}}
{{--                                               <?php--}}
{{--                                               $winner_position_two = \App\Models\User::find($award->position_two)--}}
{{--                                               ?>--}}
{{--                                               <div class="card-body text-center">--}}
{{--                                                   <div class="d-inline-flex align-items-end justify-content-end">--}}
{{--                                                       <img src="{{url('assets/images/user/avatar-2.jpg')}}" alt="images" class="img-fluid avtar avtar-xl">--}}
{{--                                                   </div>--}}
{{--                                                   <h5 class="mt-4">{{$winner_position_two->name}}</h5>--}}
{{--                                                   <p>Position Two</p>--}}
{{--                                                   <div class="btn-group">--}}
{{--                                                       <button type="button" class="btn btn-outline-info rounded border mr-3">Send Message</button>--}}
{{--                                                       <a href="{{url("adm/view/adm/".$winner_position_two->id."/profile/role_id=".$winner_position_two->role_id)}}"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>--}}
{{--                                                       --}}{{--                                                    <a href="#!"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>--}}
{{--                                                   </div>--}}
{{--                                               </div>--}}
{{--                                           </div>--}}
{{--                                       </div>--}}
{{--                                   @endif--}}
{{--                                   @if($award->position_three)--}}
{{--                                       <div class="col-md-4">--}}
{{--                                           <div class="card">--}}
{{--                                               <div class="card-header pb-0 mb-2">--}}
{{--                                                   {{$award->name}}--}}
{{--                                               </div>--}}
{{--                                               <?php--}}
{{--                                               $winner_position_three = \App\Models\User::find($award->position_three)--}}
{{--                                               ?>--}}
{{--                                               <div class="card-body text-center">--}}
{{--                                                   <div class="d-inline-flex align-items-end justify-content-end">--}}
{{--                                                       <img src="{{url('assets/images/user/avatar-2.jpg')}}" alt="images" class="img-fluid avtar avtar-xl">--}}
{{--                                                   </div>--}}
{{--                                                   <h5 class="mt-4">{{$winner_position_three->name}}</h5>--}}
{{--                                                   <p>Position Three</p>--}}
{{--                                                   <div class="btn-group">--}}
{{--                                                       <button type="button" class="btn btn-outline-info rounded border mr-3">Send Message</button>--}}
{{--                                                       <a href="{{url("adm/view/adm/".$winner_position_three->id."/profile/role_id=".$winner_position_three->role_id)}}"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>--}}
{{--                                                       --}}{{--                                                    <a href="#!"><button type="button" class="btn btn-outline-info rounded border">View Profile</button></a>--}}
{{--                                                   </div>--}}
{{--                                               </div>--}}
{{--                                           </div>--}}
{{--                                       </div>--}}
{{--                                   @endif--}}
                        @endforeach
                        </div>
                        <a href="{{url('/adm/'.$auth_admin->id.'/list/awards')}}" class="float-right">View All Awards <span><i class="fa fa-arrow-right"></i></span></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12" id="announcements">
        <div class="card">
            <div class="card-header">
                <h5>Announcements</h5>
                <a href="{{url('/adm/'.$auth_admin->id.'/add/new/announcement')}}" class="btn btn-outline-info float-right">Add Announcement</a>
            </div>
            <?php
            $announcements = \App\Models\Announcement::orderBy('created_at','desc')->limit(3)->get();
            ?>
            @if($announcements)
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($announcements as $announcement)
                            <div class="col-md-4">
                                <a target="_blank" href="{{$announcement->announcement_link}}">
                                <div class="card">
{{--                                    <img class="card-img-top" src="{{url('assets/images/slider/img-slide-3.jpg')}}" alt="Card IMAGES">--}}
                                    @if($announcement->image)
                                        <img class="card-img-top" style="height: 250px" src="{{url("Announcement/images/".$announcement->image)}}" alt="Card IMAGES">
                                    @else
                                        <img class="card-img-top"  style="height: 250px" src="{{url("assets/images/icon_video.png")}}" alt="Card IMAGES">
                                    @endif
                                    <div class="card-header">
                                        <div class="media">
{{--                                            <img src="{{url('assets/images/uikit/card-icon-1.svg')}}" alt="images" class="img-fluid">--}}
                                            <div style="height: 150px" class="media-body ml-3">
{{--                                                <h6 class="mb-2">Death Star original maps and blueprint.pdf</h6>--}}
                                                <h5 class="mb-2">{{$announcement->title}}</h5>
{{--                                                <p class="mb-0">by Ashoka T. • 06/20/2019 at 6:43 PM </p>--}}
                                                <div class="d-inline-block text-truncate" style="max-height: 100px;">{{$announcement->description}}</div>
                                                <div style="color: grey;font-size: 12px; position: absolute; bottom: 0;" class="mt-4 mb-2">{{date('l dS M, Y',strtotime($announcement->created_at))}}</div>
                                            </div>
                                        </div>
{{--                                        <div class="card-header-right">--}}
{{--                                            <div class="btn-group card-option">--}}
{{--                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                    <i class="feather icon-more-horizontal"></i>--}}
{{--                                                </button>--}}
{{--                                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">--}}
{{--                                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>--}}
{{--                                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{url('/adm/'.$auth_admin->id.'/list/announcements')}}" class="float-right">View All Announcements <span><i class="fa fa-arrow-right"></i></span></a>
                </div>
            @endif
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
                                fontSize: '14px'
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
                                fontSize: '14px'
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
                                fontSize: '14px'
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
                                fontSize: '14px'
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
                colors: ["#FFB800","#B92DB7","#B92D67","#FF7F6A"],
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

