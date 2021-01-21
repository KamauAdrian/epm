<!--sidebar nav -->
<?php
$pm_role = \App\Models\Role::where('name','Project Manager')->first();
$cm_role = \App\Models\Role::where('name','Center Manager')->first();
$trainer_role = \App\Models\Role::where('name','Trainer')->first();
$mentor_role = \App\Models\Role::where('name','Mentor')->first();
?>
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Dashboard</label>
                </li>
                <li class="nav-item"><a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Emobilis HQ</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#!">HQs</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Ajira PMO</span></a>
                    <ul class="pcoded-submenu">
                        @if($pm_role)
                            <li><a href="{{url('/list/all/admins/role_id='.$pm_role->id)}}">View PMO</a></li>
                        @else
                            <li><a href="{{url('/adm/add/pm')}}">Add PMO</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-sitemap"></i></span><span class="pcoded-mtext">Centers</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{url('/list-centers')}}">View Centers</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Center Managers</span></a>
                    <ul class="pcoded-submenu">
                        @if($cm_role)
                            <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}">View Center Managers</a></li>
                        @else
                            <li><a href="{{url('/adm/add/cm')}}">Add Center Manager</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Trainers</span></a>
                    <ul class="pcoded-submenu">
                        @if($trainer_role)
                            <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}">View Trainers</a></li>
                        @else
                            <li><a href="{{url('/adm/add/trainer')}}">Add Trainer</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Teams</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{url('/list-team-cms')}}">View CM Teams</a></li>
                        <li><a href="{{url('/list-team-trainers')}}">View Trainers Teams</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Sessions</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{url('/list-sessions')}}">View Sessions</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Mentors</span></a>
                    <ul class="pcoded-submenu">
                        @if($mentor_role)
                            <li><a href="{{url('/list/all/admins/role_id='.$mentor_role->id)}}">View Mentors</a></li>
                        @else
                            <li><a href="{{url('/adm/add/mentor')}}">Add Mentor</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-file-invoice"></i></span><span class="pcoded-mtext">Ajira Clubs</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{url('/ajira-clubs')}}">View Clubs</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-clipboard-list"></i></span><span class="pcoded-mtext">Projects</span></a>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Reports</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#!">HQs</a></li>
                        <li><a href="#!">CMs</a></li>
                        <li><a href="#!">Trainers</a></li>
                        <li><a href="#!">Teams</a></li>
                        <li><a href="#!">Centers</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">M & E</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="#!">Program Overview</a></li>
                        <li><a href="#!">Lessons Learnt</a></li>
                    </ul>
                </li>
            </ul>
            <div class="card text-center">
                <div class="card-block">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="far fa-life-ring f-40"></i>
                    <h6 class="mt-3">Help?</h6>
                    <p>Please contact us on our email for need any support</p>
                    <a href="#!" target="_blank" class="btn btn-primary btn-sm text-white m-0">Support</a>
                </div>
            </div>
