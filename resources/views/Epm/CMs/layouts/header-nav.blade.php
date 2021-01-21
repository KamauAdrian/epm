<!--header start-->
<div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="{{url('adm-dashboard')}}" class="b-brand">
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
                        <li><a href="{{url('/cm-dashboard')}}" class="dropdown-item"><i class="fas fa-circle"></i> Dashboard</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Emobilis HQ</a></li>
                        <li><a href="{{url('/cm/list-pms')}}" class="dropdown-item"><i class="fas fa-circle"></i>Ajira PMO</a></li>
                        <li><a href="{{url('/cm/list-centers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Centers</a></li>
                        <li><a href="{{url('/cm/list-cms')}}" class="dropdown-item"><i class="fas fa-circle"></i>Center Managers</a></li>
                        <li><a href="{{url('/cm/list-trainers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Trainers</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Teams</a></li>
                        <li><a href="{{url('/cm/list-sessions')}}" class="dropdown-item"><i class="fas fa-circle"></i>Sessions</a></li>
                        <li><a href="{{url('/cm/list-mentors')}}" class="dropdown-item"><i class="fas fa-circle"></i>Mentors</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Ajira Clubs</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Projects</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>Reports</a></li>
                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i>M & E</a></li>
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
                        <li><a href="{{url('/adm-profile-public')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                        <li><a href="{{url('/admin-logout')}}" class="dropdown-item"><i class="feather icon-lock"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>
