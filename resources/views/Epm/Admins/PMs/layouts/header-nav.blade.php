<!--header start-->
<div class="m-header">
    <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
    <a href="{{url('/pm-dashboard')}}" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="{{url('assets/images/epm-logo.jpeg')}}" alt="" class="img-fluid mb-5">
{{--        <img src="{{url('assets/images/logo-dark.svg')}}" alt="" class="logo">--}}
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
                        <li><a href="{{url('pm-dashboard')}}" class="dropdown-item"><i class="fas fa-circle"></i> Dashboard</a></li>
                        <li><a href="{{url('adm-Centers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Centers</a></li>
                        <li><a href="{{url('adm-cms-list')}}" class="dropdown-item"><i class="fas fa-circle"></i>Center Managers</a></li>
                        <li><a href="{{url('adm-trainers')}}" class="dropdown-item"><i class="fas fa-circle"></i>Trainers</a></li>
                        <li><a href="{{url('adm-sessions')}}" class="dropdown-item"><i class="fas fa-circle"></i>Sessions</a></li>
                        <li><a href="{{url('adm-ajira-clubs')}}" class="dropdown-item"><i class="fas fa-circle"></i>Ajira Clubs</a></li>
                        <li><a href="{{url('adm-invoice')}}" class="dropdown-item"><i class="fas fa-circle"></i> Invoice</a></li>
                        <li><a href="{{url('adm-em-inbox')}}" class="dropdown-item"><i class="fas fa-circle"></i> Inbox</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <div class="dropdown mega-menu">
                <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">
                    <i class="feather icon-layers mr-2"></i>
                    <span class="d-none d-sm-inline-block">Components</span>
                </a>
                <div class="dropdown-menu profile-notification ">
                    <div class="row no-gutters">
                        <div class="col">
                            <h6 class="mega-title">Primitives</h6>
                            <ul class="pro-body">
                                <li><a href="bc-colors.html" class="dropdown-item"><i class="fas fa-circle"></i> Colors</a></li>
                                <li><a href="bc-typography.html" class="dropdown-item"><i class="fas fa-circle"></i> Typography</a></li>
                                <li><a href="bc-richtext.html" class="dropdown-item"><i class="fas fa-circle"></i> Rich Text</a></li>
                                <li><a href="bc-shadows.html" class="dropdown-item"><i class="fas fa-circle"></i> Elevation & Shadows</a></li>
                                <li><a href="bc-border.html" class="dropdown-item"><i class="fas fa-circle"></i> Shapes & Curves</a></li>
                            </ul>
                            <h6 class="mega-title mt-1">Landingpage</h6>
                            <ul class="pro-body">
                                <li><a href="landingpage.html" class="dropdown-item"><i class="fas fa-circle"></i> Landingpage</a></li>
                            </ul>
                            <h6 class="mega-title mt-1">Table</h6>
                            <ul class="pro-body">
                                <li><a href="tbl-bootstrap.html" class="dropdown-item"><i class="fas fa-circle"></i> Bootstrap</a></li>
                                <li><a href="tbl-datatable.html" class="dropdown-item"><i class="fas fa-circle"></i> Datatable</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <h6 class="mega-title">UI Components</h6>
                            <ul class="pro-body">
                                <li><a href="bc-alerts.html" class="dropdown-item"><i class="fas fa-circle"></i> Alerts</a></li>
                                <li><a href="bc-accordions.html" class="dropdown-item"><i class="fas fa-circle"></i> Accordions</a></li>
                                <li><a href="bc-avatars.html" class="dropdown-item"><i class="fas fa-circle"></i> Avatars</a></li>
                                <li><a href="bc-badges.html" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a></li>
                                <li><a href="bc-breadcrumbs.html" class="dropdown-item"><i class="fas fa-circle"></i> Breadcrumbs</a></li>
                                <li><a href="bc-button.html" class="dropdown-item"><i class="fas fa-circle"></i> Button</a></li>
                                <li><a href="bc-button-group.html" class="dropdown-item"><i class="fas fa-circle"></i> Buttons Groups</a></li>
                                <li><a href="bc-cards.html" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a></li>
                                <li><a href="bc-conversation.html" class="dropdown-item"><i class="fas fa-circle"></i> Conversation</a></li>
                                <li><a href="bc-datepickers.html" class="dropdown-item"><i class="fas fa-circle"></i> Date Pickers</a></li>
                                <li><a href="bc-icons.html" class="dropdown-item"><i class="fas fa-circle"></i> Icons</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <h6 class="mega-title">UI Components</h6>
                            <ul class="pro-body">
                                <li><a href="bc-menus.html" class="dropdown-item"><i class="fas fa-circle"></i> Menus</a></li>
                                <li><a href="bc-sliderscarousel.html" class="dropdown-item"><i class="fas fa-circle"></i> Media Sliders / Carousel</a></li>
                                <li><a href="bc-modals.html" class="dropdown-item"><i class="fas fa-circle"></i> Modals</a></li>
                                <li><a href="bc-pagination.html" class="dropdown-item"><i class="fas fa-circle"></i> Pagination</a></li>
                                <li><a href="bc-barsgraphs.html" class="dropdown-item"><i class="fas fa-circle"></i> Progress Bars & Graphs</a></li>
                                <li><a href="bc-searchbar.html" class="dropdown-item"><i class="fas fa-circle"></i> Search Bar</a></li>
                                <li><a href="bc-tabs.html" class="dropdown-item"><i class="fas fa-circle"></i> Tabs</a></li>
                                <li><a href="bc-toasts.html" class="dropdown-item"><i class="fas fa-circle"></i> Toasts</a></li>
                                <li><a href="bc-tooltips.html" class="dropdown-item"><i class="fas fa-circle"></i> Tooltips</a></li>
                                <li><a href="bc-uploadareas.html" class="dropdown-item"><i class="fas fa-circle"></i> Upload Areas</a></li>
                                <li><a href="bc-spinner.html" class="dropdown-item"><i class="fas fa-circle"></i> Spinner</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <h6 class="mega-title">Advance Components</h6>
                            <ul class="pro-body">
                                <li><a href="bc-advancedstats.html" class="dropdown-item"><i class="fas fa-circle"></i> Advanced Stats</a></li>
                                <li><a href="bc-advancedcards.html" class="dropdown-item"><i class="fas fa-circle"></i> Advanced Cards</a></li>
                                <li><a href="ac-lightbox.html" class="dropdown-item"><i class="fas fa-circle"></i> Lightbox</a></li>
                                <li><a href="ac-notification.html" class="dropdown-item"><i class="fas fa-circle"></i> Notification</a></li>
                                <li><a href="ac-pnotify.html" class="dropdown-item"><i class="fas fa-circle"></i> Pnotify</a></li>
                                <li><a href="ac-rating.html" class="dropdown-item"><i class="fas fa-circle"></i> Rating</a></li>
                                <li><a href="bc-sidebarforms.html" class="dropdown-item"><i class="fas fa-circle"></i> Sidebar Forms</a></li>
                                <li><a href="ac-sweetalert.html" class="dropdown-item"><i class="fas fa-circle"></i> Sweetalert</a></li>
                                <li><a href="ac-syn-highlighter.html" class="dropdown-item"><i class="fas fa-circle"></i> Syntax Highlighter</a></li>
                            </ul>

                        </div>
                        <div class="col">
                            <h6 class="mega-title">Forms</h6>
                            <ul class="pro-body">
                                <li><a href="bc-inputs.html" class="dropdown-item"><i class="fas fa-circle"></i> Inputs</a></li>
                                <li><a href="bc-selects.html" class="dropdown-item"><i class="fas fa-circle"></i> Selects</a></li>
                                <li><a href="bc-f-validation.html" class="dropdown-item"><i class="fas fa-circle"></i> Form Validation</a></li>
                                <li><a href="bc-f-masking.html" class="dropdown-item"><i class="fas fa-circle"></i> Form Masking</a></li>
                                <li><a href="bc-f-wizard.html" class="dropdown-item"><i class="fas fa-circle"></i> Form Wizard</a></li>
                                <li><a href="bc-f-picker.html" class="dropdown-item"><i class="fas fa-circle"></i> Form Picker</a></li>
                                <li><a href="bc-f-select.html" class="dropdown-item"><i class="fas fa-circle"></i> Form Select</a></li>
                            </ul>
                            <h6 class="mega-title mt-1">Extension</h6>
                            <ul class="pro-body">
                                <li><a href="page-editor.html" class="dropdown-item"><i class="fas fa-circle"></i> Editor</a></li>
                                <li><a href="page-image-croper.html" class="dropdown-item"><i class="fas fa-circle"></i> Image Cropper</a></li>
                            </ul>
                        </div>
                    </div>
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
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                    <i class="icon feather icon-bell"></i>
                    <span class="badge badge-circular badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right notification">
                    <ul class="noti-body">
                        <li class="n-title">
                            <p class="m-b-0">NEW</p>
                        </li>
                        <li class="notification">
                            <div class="media">
                                <img class="img-radius" src="{{url('assets/images/user/avatar-1.jpg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <p><strong>John Doe</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>5 min</span></p>
                                    <p>New ticket Added</p>
                                </div>
                            </div>
                        </li>
                        <li class="n-title">
                            <p class="m-b-0">EARLIER</p>
                        </li>
                        <li class="notification">
                            <div class="media">
                                <img class="img-radius" src="{{url('assets/images/user/avatar-2.jpg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>10 min</span></p>
                                    <p>Prchace New Theme and make payment</p>
                                </div>
                            </div>
                        </li>
                        <li class="notification">
                            <div class="media">
                                <img class="img-radius" src="{{url('assets/images/user/avatar-1.jpg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <p><strong>Sara Soudein</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>12 min</span></p>
                                    <p>currently login</p>
                                </div>
                            </div>
                        </li>
                        <li class="notification">
                            <div class="media">
                                <img class="img-radius" src="{{url('assets/images/user/avatar-2.jpg')}}" alt="Generic placeholder image">
                                <div class="media-body">
                                    <p><strong>Joseph William</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>
                                    <p>Prchace New Theme and make payment</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="noti-footer">
                        <a href="#!">show all</a>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="dropdown drp-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{url('assets/images/user.png')}}" title="logged in as {{auth()->user()->role->name}}" class="img-radius" alt="User-Profile-Image">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-notification">
                    <ul class="pro-body">
                        <li><a href="{{url('/adm-profile-public')}}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                        <li><a href="adm-profile-conversations.html" class="dropdown-item"><i class="feather icon-mail"></i> My Messages</a></li>
                        <li><a href="{{url('/admin/logout')}}" class="dropdown-item"><i class="feather icon-lock"></i> Log out</a></li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>
