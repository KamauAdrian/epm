<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title','Emobilis - EPM')</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"> -->
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />
    <meta name="image" content="https://create.tunitrivia.com/triviapics/EOYDCZNU.png" />
    <meta property="og:image" content="https://create.tunitrivia.com/triviapics/EOYDCZNU.png" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{url('assets/images/favicon.ico')}}" type="image/x-icon">
{{--    <link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">--}}
    <!-- vendor css -->
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    {{--    <link href="{{url('quill-1.3.6/docs/assets/css/styles.css')}}" rel="stylesheet">--}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        strong { font-weight: bold !important; }
    </style>
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
{{--            @yield('sidebar-nav')--}}
            @include('Epm.layouts.sidebar-nav')
        </div>
    </div>
</nav>
<!-- [ sidebar-nav ] end -->

<!-- [ header-navbar ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed ">
{{--    @yield('header-nav')--}}
    @include('Epm.layouts.header-nav')
</header>
<!-- [ header-navbar ] end -->

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content container">
        <div class="row">
            <div class="col-md-12">
                <center>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="text-success"><h5>{{session()->get('success')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </center>
            </div>
        </div>
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Required Js -->
<script src="{{url('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/plugins/apexcharts.min.js')}}"></script>
<script src="{{url('assets/js/pcoded.min.js')}}"></script>
<script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
<script src="{{url('assets/dist/vue.js')}}"></script>
<script src="{{url('assets/dist/axios.js')}}"></script>
<style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
<script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
{{--    <script src="{{url('quill-1.3.6/quill.js')}}"></script>--}}
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@yield('js')
<script src="{{url('assets/js/pages/front.js')}}"></script>
<script>
    $(document).ready(function (){
        $("#tableListDataTable").dataTable({
            "order":[],
        });
    });
    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },

        });
</script>
</body>
</html>
