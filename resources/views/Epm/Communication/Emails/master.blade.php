@extends("Epm.layouts.master")

@section("styles")
    <link rel="stylesheet" href="{{url("assets/css/plugins/trumbowyg.min.css")}}">
@endsection

@section("content")
    <?php $auth_admin = auth()->user(); ?>
    <div class="col-md-12">
        <!-- [ breadcrumb ] start -->
    {{--    <div class="page-header">--}}
    {{--        <div class="page-block">--}}
    {{--            <div class="row align-items-center">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <ul class="breadcrumb">--}}
    {{--                        <li class="breadcrumb-item"><a href="#!">Home</a></li>--}}
    {{--                        <li class="breadcrumb-item"><a href="#!">Email</a></li>--}}
    {{--                        <li class="breadcrumb-item"><a href="#!">Read Mail</a></li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- [ breadcrumb ] end -->
        <!-- [ Invoice ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card email-card">
                    <div class="card-header">
                        <div class="mail-header">
                            <div class="row align-items-center">
                                <!-- [ email-left section ] start -->
                            {{--                            <div class="col-xl-2 col-md-3">--}}
                            {{--                                <a href="index.html" class="b-brand">--}}
                            {{--                                    <img src="assets/images/logo-dark.svg" alt="" class="logo">--}}
                            {{--                                </a>--}}
                            {{--                            </div>--}}
                            <!-- [ email-left section ] end -->
                                <!-- [ email-right section ] start -->
                                <div class="col-md-12">
                                    <div class="input-group mb-0">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01"><i class="feather icon-search"></i></label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01">
                                            <option selected>Search ...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- [ email-right section ] end -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mail-body">
                            <div class="row">
                                <!-- [ email-left section ] start -->
                                <div class="col-xl-2 col-md-3">
                                    <div class="mb-3">
                                        <a href="{{url("/adm/".$auth_admin->id."/compose/email")}}" class="btn waves-effect waves-light btn-rounded btn-outline-info">+ Compose</a>
                                    </div>
                                    <ul class="mb-2 nav nav-tab flex-column nav-pills">
                                        <li class="nav-item mail-section">
                                            <a class="nav-link text-left active" href="adm-em-inbox.html">
                                                <span><i class="feather icon-inbox"></i>Index</span>
                                                <span class="float-right">6</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mail-section">
                                            <a class="nav-link text-left" href="adm-em-inbox.html">
                                                <span><i class="feather icon-star-on"></i>Starred</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mail-section">
                                            <a class="nav-link text-left" href="adm-em-inbox.html">
                                                <span><i class="feather icon-file-text"></i>Drafts</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mail-section">
                                            <a class="nav-link text-left" href="adm-em-inbox.html">
                                                <span><i class="feather icon-navigation"></i>Sent Mail</span>
                                            </a>
                                        </li>
                                        <li class="nav-item mail-section">
                                            <a class="nav-link text-left" href="adm-em-inbox.html">
                                                <span><i class="feather icon-trash-2"></i>Trash</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <a class="email-more-link" data-toggle="collapse" href="#email-more-cont" role="button" aria-expanded="false" aria-controls="email-more-cont"><span><i
                                                class="feather icon-chevron-down mr-2"></i>More</span><span style="display: none;"><i class="feather icon-chevron-up mr-2"></i>Less</span></a>
                                    <div class="collapse" id="email-more-cont">
                                        <ul class="nav nav-tab flex-column nav-pills">
                                            <li class="nav-item mail-section">
                                                <a class="nav-link text-left">
                                                    <span><i class="feather icon-zap"></i> Important</span>
                                                    <span class="float-right">6</span>
                                                </a>
                                            </li>
                                            <li class="nav-item mail-section">
                                                <a class="nav-link text-left">
                                                    <span><i class="feather icon-message-circle"></i> Chats</span>
                                                </a>
                                            </li>
                                            <li class="nav-item mail-section">
                                                <a class="nav-link text-left">
                                                    <span><i class="feather icon-alert-triangle"></i> Spam</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- [ email-left section ] end -->
                                <!-- [ email-right section ] start -->
                                <div class="col-xl-10 col-md-9">
                                        @yield("eContent")
                                </div>
                                <!-- [ email-right section ] start -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ email-read ] end -->
            </div>
        </div>
        <!-- [ Invoice ] end -->
    </div>
@endsection
@section("js")
    <script src="{{url("assets/js/plugins/trumbowyg.min.js")}}"></script>
@endsection
