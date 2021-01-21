<!--header start-->
<?php
$auth_admin = auth()->user();
$pm_role = \App\Models\Role::where('name','Project Manager')->first();
$cm_role = \App\Models\Role::where('name','Center Manager')->first();
$trainer_role = \App\Models\Role::where('name','Trainer')->first();
$mentor_role = \App\Models\Role::where('name','Mentor')->first();
?>
<div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="{{url('/adm/main/dashboard')}}" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="{{url('assets/images/epm-logo.jpeg')}}" alt="" class="logo">
    </a>
    <a href="#!" class="mob-toggler">
        <i class="feather icon-more-vertical"></i>
    </a>
</div>
<div class="collapse navbar-collapse">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <div class="dropdown">
                <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                    <i class="feather icon-monitor mx-2"></i>
                    <span class="d-none d-sm-inline-block">Dashboard</span>
                </a>
                <div class="dropdown-menu profile-notification ">
                    <ul class="pro-body">
{{--                        //Dashboard--}}
                        <li><a href="{{url('/adm/main/dashboard')}}" class="dropdown-item"><i class="fas fa-circle"></i> Dashboard</a></li>

{{--                        //Emobilis HQs--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Emobilis HQ</a></li>
                        @endif

{{--                        //Ajira PMOs--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            @if($pm_role)
                                <li><a href="{{url('/list/all/admins/role_id='.$pm_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Ajira PMO</a></li>
                            @else
                                <li><a href="{{url('/adm/add/pm')}}" class="dropdown-item"><i class="fas fa-circle"></i>Ajira PMO</a></li>
                            @endif
                        @endif

{{--                        //centers--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="{{url('/list-centers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Centers</a></li>
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="{{url('/list-centers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Centers</a></li>
                        @endif

{{--                        //Center Managers--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            @if($cm_role)
                                <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Center Managers</a></li>
                            @else
                                <li><a href="{{url('/adm/add/cm')}}" class="dropdown-item"><i class="fas fa-circle"></i>Center Managers</a></li>
                            @endif
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Center Managers</a></li>
                        @endif

{{--                        //Trainers--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            @if($trainer_role)
                                <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Trainers</a></li>
                            @else
                                <li><a href="{{url('/adm/add/trainer')}}" class="dropdown-item"><i class="fas fa-circle"></i>Trainers</a></li>
                            @endif
                        @elseif($auth_admin->role->name == 'Trainer')
                                <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Trainers</a></li>
                        @endif

{{--                        //Teams--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Teams</a></li>
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Teams</a></li>
                        @elseif($auth_admin->role->name == 'Trainer')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Teams</a></li>
                        @endif

{{--                        //Sessions--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="{{url('/list-sessions')}}" class="dropdown-item"><i class="fas fa-circle"></i>Sessions</a></li>
                        @elseif($auth_admin->role->name == 'Trainer')
                            <li><a href="{{url('/list-sessions')}}" class="dropdown-item"><i class="fas fa-circle"></i>Sessions</a></li>
                        @endif

{{--                        //Mentors--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            @if($mentor_role)
                                <li><a href="{{url('/list/all/admins/role_id='.$mentor_role->id)}}" class="dropdown-item"><i class="fas fa-circle"></i>Mentors</a></li>
                            @else
                                <li><a href="{{url('/adm/add/mentor')}}" class="dropdown-item"><i class="fas fa-circle"></i>Mentors</a></li>
                            @endif
                        @endif

{{--                        //Ajira Clubs--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="{{url('/ajira-clubs')}}" class="dropdown-item"><i class="fas fa-circle"></i>Ajira Clubs</a></li>
                        @endif

{{--                        //Projects--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Projects</a></li>
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Projects</a></li>
                        @elseif($auth_admin->role->name == 'Trainer')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Projects</a></li>
                        @endif

{{--                        //Reports--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Reports</a></li>
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Reports</a></li>
                        @elseif($auth_admin->role->name == 'Trainer')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Reports</a></li>
                        @endif

{{--                        //M&E--}}
                        @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>M & E</a></li>
                        @elseif($auth_admin->role->name == 'Center Manager')
                            <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>M & E</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </li>

        <li class="nav-item d-inline-block d-md-none">
            <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
            <div class="search-bar">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search here">
                <button type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </li>
        <li class="nav-item h-auto d-none d-md-inline-block">
            <div class="input-group search-form">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent"><i class="feather icon-search"></i></span>
                </div>
                <input type="text" class="form-control nav-search" placeholder="Search">
            </div>
        </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <li>
            <div class="dropdown drp-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{url('assets/images/user.png')}}" title="logged in as {{auth()->user()->role->name}}" class="img-radius" alt="User-Profile-Image">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-notification">
                    <ul class="pro-body">
                        <li><a href="{{url('/adm/'.auth()->id().'/profile/public/role_id='.auth()->user()->role->id.'/view')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                        <li><a href="{{url('/admin-logout')}}" class="dropdown-item"><i class="feather icon-lock"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>
