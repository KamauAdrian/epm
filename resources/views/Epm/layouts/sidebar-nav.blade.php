<!--sidebar nav -->
<?php
    $auth_admin = auth()->user();
$pm_role = \App\Models\Role::where('name','Project Manager')->first();
$cm_role = \App\Models\Role::where('name','Center Manager')->first();
$trainer_role = \App\Models\Role::where('name','Trainer')->first();
$mentor_role = \App\Models\Role::where('name','Mentor')->first();
?>
<ul class="nav pcoded-inner-navbar ">
    <li class="nav-item pcoded-menu-caption">
        <label>Dashboard</label>
    </li>
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item"><a href="{{url('adm/main/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Emobilis HQ</span></a>
            <ul class="pcoded-submenu">
                <li><a href="#!">HQs</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Ajira PMO</span></a>
            <ul class="pcoded-submenu">
                @if($pm_role)
                    <li><a href="{{url('/list/all/admins/role_id='.$pm_role->id)}}">View PMO</a></li>
                @else
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/add/admin/role_name=Project Manager')}}">Add PMO</a></li>
                @endif
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-sitemap"></i></span><span class="pcoded-mtext">Centers</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/centers')}}">View Centers</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Center Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-sitemap"></i></span><span class="pcoded-mtext">Centers</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/centers')}}">View Centers</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Center Managers</span></a>
            <ul class="pcoded-submenu">
                @if($cm_role)
                    <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}">View Center Managers</a></li>
                @else
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/add/admin/role_name=Center Manager')}}">Add Center Manager</a></li>
                @endif
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Center Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Center Managers</span></a>
            <ul class="pcoded-submenu">
                    <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}">View Center Managers</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Trainers</span></a>
            <ul class="pcoded-submenu">
                @if($trainer_role)
                    <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}">View Trainers</a></li>
                @else
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/add/admin/role_name=Trainer')}}">Add Trainer</a></li>
                @endif
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Trainer')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Trainers</span></a>
            <ul class="pcoded-submenu">
                    <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}">View Trainers</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Teams</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/team/cms')}}">Team CMs</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/team/trainers')}}">Team Trainers</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Center Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Teams</span></a>
            <ul class="pcoded-submenu">
{{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/my/teams')}}">My Teams</a></li>--}}
                <li><a href="#!">My Teams</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Trainer')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Teams</span></a>
            <ul class="pcoded-submenu">
{{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/my/teams')}}">My Teams</a></li>--}}
                <li><a href="#!">My Teams</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Classes</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('adm/'.$auth_admin->id.'/list/classes')}}">View Classes</a></li>
            </ul>
        </li>
    @endif
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Sessions</span></a>
        <ul class="pcoded-submenu">
            <li><a href="{{url('/adm/'.$auth_admin->id.'/list/sessions')}}">View Sessions</a></li>
        </ul>
    </li>
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Mentors</span></a>
            <ul class="pcoded-submenu">
                @if($mentor_role)
                    <li><a href="{{url('/list/all/admins/role_id='.$mentor_role->id)}}">View Mentors</a></li>
                @else
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/add/admin/role_name=Mentor')}}">Add Mentor</a></li>
                @endif
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-file-invoice"></i></span><span class="pcoded-mtext">Ajira Clubs</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/ajira-clubs')}}">View Clubs</a></li>
            </ul>
        </li>
    @endif
    <li class="nav-item">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-clipboard-list"></i></span><span class="pcoded-mtext">Projects</span></a>
    </li>
    @if($auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Su Admin')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Reports</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template')}}">Templates</a></li>
                @if($pm_role)
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/target_group_id='.$pm_role->id)}}">PMs</a></li>
                @endif
                @if($cm_role)
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/target_group_id='.$cm_role->id)}}">CMs</a></li>
                @endif
                @if($trainer_role)
                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/reports')}}">Trainers</a></li>
                @endif
                <li><a href="#!">Teams</a></li>
                <li><a href="#!">Centers</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Center Manager')
        <?php
        $cm_role_id = $cm_role->id;
        $cm_reports = $cm_role->templates;
        ?>
    @if($cm_reports)
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Reports</span></a>
            <ul class="pcoded-submenu">
                @foreach($cm_reports as $cm_report)
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/template_id='.$cm_report->id)}}">{{$cm_report->name}}</a></li>
{{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/team/reports')}}">{{$cm_report->name}}</a></li>--}}
                @endforeach
            </ul>
        </li>
    @endif
    @elseif($auth_admin->role->name == 'Trainer')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Reports</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/training/sessions/allocations')}}">Training Sessions Allocations</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/reports')}}">Daily Attendance Report</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/virtual/training/reports')}}">Daily Virtual Training Report</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/physical/training/reports')}}">Daily Physical Training Report</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/assignment/submission/reports')}}">Assigment submission</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/competence/reports')}}">Competency Reports</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/leave/applications')}}">Leave Applications</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Center Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">M & E</span></a>
            <ul class="pcoded-submenu">
                <li><a href="#!">Program Overview</a></li>
                <li><a href="#!">Lessons Learnt</a></li>
            </ul>
        </li>
    @endif
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
