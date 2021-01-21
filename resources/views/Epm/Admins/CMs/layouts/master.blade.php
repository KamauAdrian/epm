<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title','Treva - UIKit')</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
{{--    <link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">--}}
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    @yield('styles')
    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>
</head>

<body>
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->

<!-- [ sidebar-nav ] start -->
<nav class="pcoded-navbar dashboard-nav menu-light menupos-fixed ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            @include('Epm.Admins.CMs.layouts.sidebar-nav')
        </div>
    </div>
</nav>
<!-- [ sidebar-nav ] end -->

<!-- [ header-navbar ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed ">
    @include('Epm.Admins.CMs.layouts.header-nav')
</header>
<!-- [ header-navbar ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Required Js -->
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
@yield('js')
<script src="{{url('assets/js/pages/front.js')}}"></script>
</body>
</html>











{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}

{{--<head>--}}
{{--    <title>@yield('title','Treva - UIKit')</title>--}}
{{--    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->--}}
{{--    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->--}}
{{--    <!--[if lt IE 11]>--}}
{{--    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>--}}
{{--    <![endif]-->--}}
{{--    <!-- Meta -->--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"> -->--}}
{{--    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->--}}
{{--    <meta name="description" content="" />--}}
{{--    <meta name="keywords" content="">--}}
{{--    <meta name="author" content="Codedthemes" />--}}
{{--    <!-- Favicon icon -->--}}
{{--    <link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">--}}
{{--    <!-- vendor css -->--}}
{{--    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">--}}
{{--    @yield('styles')--}}
{{--    <script src="{{url('assets/js/vendor-all.min.js')}}"></script>--}}
{{--</head>--}}

{{--<body class="landing-page front">--}}
{{--<!-- [ Pre-loader ] start -->--}}
{{--<div class="loader-bg">--}}
{{--    <div class="loader-track">--}}
{{--        <div class="loader-fill"></div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<!-- [ Pre-loader ] End -->--}}

{{--<!-- [ header-nav ] start -->--}}
{{--<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed ">--}}
{{--    @include('Epm.Admins.layouts.header-nav')--}}
{{--</header>--}}
{{--<!-- [ header-nav ] end -->--}}

{{--@yield('content')--}}
{{--<!-- Required Js -->--}}
{{--<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{url('assets/js/pcoded.min.js')}}"></script>--}}
{{--<script src="{{url('assets/js/pages/front.js')}}"></script>--}}
{{--@yield('js')--}}

{{--</body>--}}
{{--</html>--}}
