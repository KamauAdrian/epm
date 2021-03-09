<!--sidebar nav -->
<?php
use App\Models\CmsReport;use App\Models\PmoPerformanceAppraisal;$auth_admin = auth()->user();
$pm_role = \App\Models\Role::where('name','Project Manager')->first();
$cm_role = \App\Models\Role::where('name','Center Manager')->first();
$trainer_role = \App\Models\Role::where('name','Trainer')->first();
$mentor_role = \App\Models\Role::where('name','Mentor')->first();
?>
<ul class="nav pcoded-inner-navbar ">
    <li class="nav-item pcoded-menu-caption">
        <label>Dashboard</label>
    </li>

    <li class="nav-item">
        <a href="{{url('/adm/main/dashboard')}}" class="nav-link ">
            <span class="pcoded-micon"><i class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span>
        </a>
    </li>
    @if($auth_admin->role->name == 'Su Admin')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-clipboard-list"></i></span><span class="pcoded-mtext">Work Streams</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/projects')}}">View Work Streams</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == 'Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-clipboard-list"></i></span><span class="pcoded-mtext">Work Streams</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/my/projects')}}">My Work Streams</a></li>
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/project/collaborations')}}">Collaborations</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name =='Project Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Emobilis HQ</span></a>
            <ul class="pcoded-submenu">
                <li><a href="#!">HQs</a></li>
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager" || $auth_admin->role->name == "Trainer")
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Ajira PMO</span></a>
            <ul class="pcoded-submenu">
                @if($pm_role)
                    <li><a href="{{url('/list/all/admins/role_id='.$pm_role->id)}}">View PMO</a></li>
                    @if($auth_admin->role->name == "Su Admin")
                        <li>
                            <a href="#!">PMO Reports</a>
                            <ul class="pcoded-submenu">
                                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisals')}}">Performance Appraisals</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
            </ul>
        </li>
    @endif
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager' || $auth_admin->role->name == 'Center Manager')
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-sitemap"></i></span><span class="pcoded-mtext">Centers</span></a>
            <ul class="pcoded-submenu">
                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/centers')}}">View Centers</a></li>
                <li>
                    <a href="#!">Center Managers</a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{url('/list/all/admins/role_id='.$cm_role->id)}}">View Center Managers</a></li>
                        @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Ajira Youth Empowerment Centers (AYECs)")
                            <li><a href="{{url('/adm/'.$auth_admin->id.'/view/cms/reports')}}">Center Manager Reports</a></li>
                            <li><a href="{{url('/adm/'.$auth_admin->id.'/list/team/cms')}}">Center Manager Teams</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </li>
    @endif
{{--    @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager" || $auth_admin->role->name == "Center Manager" || $auth_admin->role->name == "Trainer")--}}
{{--        <li class="nav-item pcoded-hasmenu">--}}
{{--            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Trainers</span></a>--}}
{{--            <ul class="pcoded-submenu">--}}
{{--                @if($trainer_role)--}}
{{--                    <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}">View Trainers</a></li>--}}
{{--                    @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")--}}
{{--                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/reports')}}">Trainer Reports</a></li>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')--}}
{{--        <li class="nav-item pcoded-hasmenu">--}}
{{--            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-user-circle"></i></span><span class="pcoded-mtext">Trainees</span></a>--}}
{{--            <ul class="pcoded-submenu">--}}
{{--                    <li><a href="{{url('/adm/'.$auth_admin->id.'/list/all/trainees')}}">View Trainees</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    @endif--}}
    @if($auth_admin->role->name == "Center Manager" || $auth_admin->role->name == "Trainer")
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Teams</span></a>
            <ul class="pcoded-submenu">
                {{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/my/teams')}}">My Teams</a></li>--}}
                @if($auth_admin->role->name == "Center Manager")
                    <li><a href="#!">My Teams</a></li>
                @elseif($auth_admin->role->name == "Trainer")
                {{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/list/my/teams')}}">My Teams</a></li>--}}
                  <li><a href="#!">My Teams</a></li>
                @endif
            </ul>
        </li>
    @endif
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-school"></i></span><span class="pcoded-mtext">Trainings</span></a>
        <ul class="pcoded-submenu">
        <li><a href="{{url('adm/'.$auth_admin->id.'/list/cohorts')}}">Cohorts</a></li>
        <li>
          <a href="#!">Trainers</a>
          <ul class="pcoded-submenu">
              @if($trainer_role)
                  <li><a href="{{url('/list/all/admins/role_id='.$trainer_role->id)}}">View Trainers</a></li>
                  <li><a href="{{url('/adm/'.$auth_admin->id.'/list/team/trainers')}}">Trainer Teams</a></li>
                  @if($auth_admin->role->name == "Su Admin" || $auth_admin->department == "Training")
                      <li><a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/reports')}}">Trainer Reports</a></li>
                  @endif
              @endif
          </ul>
        </li>
        <li><a href="{{url('/adm/'.$auth_admin->id.'/list/trainings')}}">Trainings</a></li>
        <li><a href="{{url('/adm/'.$auth_admin->id.'/list/all/trainees')}}">Trainees</a></li>
        </ul>
    </li>
    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-trophy"></i></span><span class="pcoded-mtext">Ajira Clubs</span></a>
        <ul class="pcoded-submenu">
          <li><a href="#!">View Clubs</a></li>
        </ul>
    </li>
    @endif
{{--    @if($auth_admin->role->name == 'Su Admin')--}}
{{--        <li class="nav-item pcoded-hasmenu">--}}
{{--            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-book"></i></span><span class="pcoded-mtext">Reports</span></a>--}}
{{--            <ul class="pcoded-submenu">--}}
{{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/reports/templates')}}">Templates</a></li>--}}
{{--                @if($pm_role)--}}
{{--                    <li>--}}
{{--                        <a href="#!">PMO</a>--}}
{{--                        <ul class="pcoded-submenu">--}}
{{--                            <li><a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisals')}}">Performance Appraisals</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--                @if($cm_role)--}}
{{--                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/cms/reports')}}">CMS</a></li>--}}
{{--                @endif--}}
{{--                @if($trainer_role)--}}
{{--                    <li><a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/reports')}}">Trainers</a></li>--}}
{{--                @endif--}}
{{--                <li><a href="#!">Teams</a></li>--}}
{{--                <li><a href="#!">Centers</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--    @endif--}}
    @if($auth_admin->role->name == "Project Manager")
        <li class="nav-item pcoded-hasmenu">
            <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-book"></i></span><span class="pcoded-mtext">Reports</span></a>
            <ul class="pcoded-submenu">
              <?php
              $appraisal_submit = \App\Models\Appraisal::where('pmo_id',$auth_admin->id)->get();
              $appraisal_supervise = \App\Models\AppraisalSupervisor::where('supervisor_id',$auth_admin->id)->get();
              ?>
                  <li>
                      <a href="#!">Appraisals</a>
                      <ul class="pcoded-submenu">
                          @if($appraisal_submit)
                              <li><a href="{{url('/adm/'.$auth_admin->id.'/view/performance/appraisals')}}">My Appraisals</a></li>
                          @endif
                          @if($appraisal_supervise)
                              <li><a href="{{url('/adm/'.$auth_admin->id.'/list/pending/pmo/performance/supervision/appraisals')}}">Supervise PMO</a></li>
                          @endif
                      </ul>
                  </li>
              <li><a href="#!">Centers</a></li>
            </ul>
        </li>
    @elseif($auth_admin->role->name == "Center Manager")
    <?php
    $cm_reports = CmsReport::orderBy("created_at","desc")->get();
    ?>
    @if($cm_reports)
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-book"></i></span><span class="pcoded-mtext">Reports</span></a>
        <ul class="pcoded-submenu">
          @foreach($cm_reports as $cm_report)
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/cms/report/'.$cm_report->id)}}">{{$cm_report->name}}</a></li>
          <li><a href="{{url('/adm/'.$auth_admin->id.'/team/reports')}}">{{$cm_report->name}}</a></li>
          @endforeach
        </ul>
    </li>
    @endif
    @elseif($auth_admin->role->name == "Trainer")
    <li class="nav-item pcoded-hasmenu">
        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fas fa-book"></i></span><span class="pcoded-mtext">Reports</span></a>
        <ul class="pcoded-submenu">
        {{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/training/sessions/allocations')}}">Training Sessions Allocations</a></li>--}}
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/attendance/reports')}}">Daily Attendance Reports</a></li>
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/training/reports')}}">Daily Training Reports</a></li>
        {{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/virtual/training/reports')}}">Daily Virtual Training Report</a></li>--}}
        {{--                <li><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/physical/training/reports')}}">Daily Physical Training Report</a></li>--}}
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/trainer/assignment/submission/reports')}}">Assigment submission</a></li>
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/competence/reports')}}">Competency Reports</a></li>
          <li><a href="{{url('/adm/'.$auth_admin->id.'/view/leave/applications')}}">Leave Applications</a></li>
        </ul>
    </li>
    @endif
    @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager" || $auth_admin->role->name == "Center Manager")
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
