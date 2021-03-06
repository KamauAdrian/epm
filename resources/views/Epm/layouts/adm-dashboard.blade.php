@extends('Epm.layouts.master')

@section('styles')
    <style>
        #footer{

            /*background-color: #7E858E;*/
        }
    </style>
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
                            <img src="{{url('assets/images/eMobilis-Slider-7.jpg')}}" style="width: 100%" alt="eMobilis">
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

                    @if($auth_admin->role->name == "Center Manager" || $auth_admin->role->name == "Trainer")
                        <div class="row">
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
{{--//best performer--}}
    <div class="col-md-12" id="awards">
        <div class="card">
            <div class="card-header">
                <h5>Awards</h5>
                <a href="{{url('/adm/'.$auth_admin->id.'/list/awards')}}" class="btn btn-outline-info float-right ml-2">View All</a>
                <a href="{{url('/adm/'.$auth_admin->id.'/create/new/award')}}" class="btn btn-outline-info float-right mr-2">Create Award</a>
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
                <a href="{{url('/adm/'.$auth_admin->id.'/list/announcements')}}" class="btn btn-outline-info float-right ml-2">View All</a>
                <a href="{{url('/adm/'.$auth_admin->id.'/add/new/announcement')}}" class="btn btn-outline-info float-right mr-2">Add Announcement</a>
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
                                <div class="card">
{{--                                    <img class="card-img-top" src="{{url('assets/images/slider/img-slide-3.jpg')}}" alt="Card IMAGES">--}}
                                    <a target="_blank" href="{{$announcement->announcement_link}}">
                                        @if($announcement->type =="Image")
                                            <img class="card-img-top" style="height: 250px" src="{{url("Announcement/images/".$announcement->image)}}" alt="Card IMAGES">

                                        @endif
                                        @if($announcement->type =="Video")
                                            <?php
                                            $url = $announcement->announcement_link;
//                                            $url = "https://www.youtube.com/watch?v=wSQU-OqfVJU&feature=youtu.be";
                                            $v_id="";
                                            $url_components = parse_url($url);
                                            parse_str($url_components["query"], $params);
                                            if ($params){
                                                $v_id ="https://img.youtube.com/vi/".$params['v']."/0.jpg";
                                            }
                                            ?>
                                            <img class="card-img-top"  style="height: 250px" src="{{$v_id}}" alt="Card IMAGES">
                                        @endif
                                    </a>
                                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")
                                        <div class="card-header">
                                            <div class="card-header-right ml-2">
                                                <div class="btn-group card-option">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="feather icon-more-horizontal"></i>
                                                    </button>
                                                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                                            <a href="{{url('/adm/'.$auth_admin->id.'/edit/announcement/'.$announcement->id)}}"><li class="dropdown-item">Edit</li></a>
                                                            <a href="#!"><li class="dropdown-item close-card">Delete</li></a>
                                                        </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body" style="height: 200px;">
                                        <div class="media">
                                            <div class="media-body ml-3">
                                                <div>
                                                    <h5 class="mb-2">{{$announcement->title}}</h5>
                                                    {{--                                                    <span class="text-right"><i class="feather icon-more-horizontal"></i></span>--}}
                                                </div>
                                                <div style="color: grey;font-size: 14px; height: 150px;" class="mb-0">
                                                    @if(strlen($announcement->description)>120)
                                                    {!! nl2br(mb_strimwidth($announcement->description, 0, 120, "...")) !!}
                                                    <div class="dropdown float-right">
                                                        <a href="#!" class="dropdown-toggle" data-toggle="dropdown"><span><u>Read More</u></span></a>
                                                        <div class="dropdown-menu p-4" style="width: 400px;">
                                                            {!! nl2br($announcement->description) !!}
                                                        </div>
                                                    </div>
                                                    @else
                                                        {!! nl2br($announcement->description) !!}
                                                    @endif
                                                </div>
                                                <div style="color: grey;font-size: 12px; position: absolute; bottom: 0;" class="mt-4 mb-2">{{date('l dS M, Y',strtotime($announcement->created_at))}}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteAdminUser" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    {{--                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Project Manager</h5>--}}
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{--                    {{url('/adm-delete-pm','hiddenValue')}}--}}
                                                    <h5 class="text-danger">Are you sure you want to delete this Admin?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" id="form-delete-user" method="post">
                                                        @csrf
                                                        <button data-data="" id="btn-delete-user" type="submit" class="btn btn-outline-success">
                                                            Yes Delete
                                                        </button>
                                                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>
                                                    </form>
                                                </div>
                                                {{--                        <div class="modal-footer">--}}
                                                {{--                            <form id="deleteAdminForm" action="" method="post">--}}
                                                {{--                                @csrf--}}
                                                {{--                                <button type="submit" class="btn btn-outline-success">Yes Delete</button>--}}
                                                {{--                                <button type="button" class="btn btn-outline-warning" data-dismiss="modal">Cancel</button>--}}
                                                {{--                            </form>--}}
                                                {{--                        </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{url('/adm/'.$auth_admin->id.'/list/announcements')}}" class="float-right">View All Announcements <span><i class="fa fa-arrow-right"></i></span></a>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12" id="footer">
       <div class="card">
           <div class="card-body">
               <div class="row m-3">
                   <div class="col-md-6 mt-2">
                       <div class="card">
                           <div class="card-header">
                               Twitter
                           </div>
                           <div class="card-body">
                               <div>
                                   <a data-tweet-limit="" data-height="600" class="twitter-timeline" href="https://twitter.com/eMobilis?ref_src=twsrc%5Etfw">Tweets by eMobilis</a>
                                   <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6 mt-2">
                       <div class="card">
                           <div class="card-header">
                               Facebook
                           </div>
                           <div class="card-body text-center">
                               <div class="fb-page" data-href="https://www.facebook.com/eMobilisMobileTech/"
                                    data-tabs="timeline,events" data-width="500"  data-height="600"
                                    data-small-header="false" data-adapt-container-width="true"
                                    data-hide-cover="false" data-show-facepile="true">
                                   <blockquote cite="https://www.facebook.com/eMobilisMobileTech/" class="fb-xfbml-parse-ignore">
                                       <a href="https://www.facebook.com/eMobilisMobileTech/">
                                           eMobilis Mobile Technology  Institute
                                       </a>
                                   </blockquote>
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

