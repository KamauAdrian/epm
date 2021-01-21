@extends('Epm.Admins.layouts.master')
@section('content')
    <header class="l-header meta-header bg-line">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6 col-sm-8">
                    <div class="home-lead">
                        <p class="">Responsive Bootstrap 4 Dashboard Template</p>
                        <h2 class="font-weight-light my-4">Make your dashboard app more professional with this <strong>Super awesome</strong> and <strong>Premium quality</strong> Dashboard &amp; UIkit design template.</h2>
                        <div class="">
                            <a href="bc-colors.html" class="btn btn-primary px-md-4">Get Started</a>
                            <a href="docs/index.html" class="btn btn-link px-md-4">Learn More</a>
                        </div>
                        <div class="d-inline-flex my-4">
                            <div class="text-success"><i class="f-26 fab fa-bootstrap"></i></div>
                            <div class="text-warning p-l-10"><i class="f-26 fab fa-html5"></i></div>
                            <div class="text-primary p-l-10"><i class="f-26 fab fa-css3-alt"></i></div>
                            <div class="text-danger p-l-10"><i class="f-26 fab fa-sass"></i></div>
                            <div class="text-success p-l-10"><i class="f-26 fab fa-js"></i></div>
                            <div class="text-danger p-l-10"><i class="f-26 fab fa-npm"></i></div>
                            <div class="text-danger p-l-10"><i class="f-26 fab fa-gulp"></i></div>
                        </div>
                        <div class="tx-12 mg-t-40">
                            <a href="docs.html" class="text-body text-h-primary">Doc<span class="d-none d-sm-inline">umentation</span><span class="d-sm-none">s</span></a>
                            <a href="" class="text-body text-h-primary m-l-10">Changelog</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-8">
                    <img src="{{url('assets/images/landing/home-moke.png')}}" alt="" class="img-fluid moke-img">
                </div>
            </div>
        </div>
    </header>

    <!-- [ demos ] start -->
<section id="layouts" class="layouts bg-dark">
    <div class="container text-center">
        <h2 class="text-white mt-4"><span>Awesome</span> layouts</h2>
        <div class="row  justify-content-center">
            <div class="col-md-6">
                <p class="mb-4">All live preview supports the LIVE CUSTOMIZER filter</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="layouts-block">
                    <img src="{{url('assets/images/landing/layout-v.jpg')}}" alt="layout image" class="img-fluid">
                    <div class="hover-data">
                        <a href="http://html.codedthemes.com/treva/bootstrap/layout-vertical.html" target="_blank" class="btn btn-success"><i class="feather icon-monitor mr-2"></i>Live Preview</a>
                    </div>
                </div>
                <p class="mb-1 mt-2"><small>Vertical</small></p>
                <h5 class="text-white">Vertical Layout</h5>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="layouts-block">
                    <img src="{{url('assets/images/landing/layout-h.jpg')}}" alt="layout image" class="img-fluid">
                    <div class="hover-data">
                        <a href="http://html.codedthemes.com/treva/bootstrap/layout-horizontal.html" target="_blank" class="btn btn-success"><i class="feather icon-monitor mr-2"></i>Live Preview</a>
                    </div>
                </div>
                <p class="mb-1 mt-2"><small>horizontal</small></p>
                <h5 class="text-white">horizontal layout</h5>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="layouts-block">
                    <img src="{{url('assets/images/landing/layout-l.jpg')}}" alt="layout image" class="img-fluid">
                    <div class="hover-data">
                        <a href="http://html.codedthemes.com/treva/bootstrap/landingpage.html" target="_blank" class="btn btn-success"><i class="feather icon-monitor mr-2"></i>Live Preview</a>
                    </div>
                </div>
                <p class="mb-1 mt-2"><small>Landing Page</small></p>
                <h5 class="text-white">Landing Page</h5>
            </div>
        </div>
    </div>
</section>
<!-- [ demos ] end -->
<!-- [ Content ] start -->
<section class="price bg-line position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 text-center mb-5">
                <h6 class="text-uppercase mb-4">eyebrow</h6>
                <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body p-5">
                        <h1 class="display-4">$36</h1>
                        <!-- <h6 class="text-body text-uppercase"> per month,<br> billed anually</h6> -->
                        <h2 class="mt-5 font-weight-normal mb-4">Single License</h2>
                        <p class="mb-4 px-md-4">you must purchase a single-license for Only one project or client.</p>
                        <button class="btn btn-outline-secondary px-md-5">Get Started</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center rec-price">
                    <span class="rec-badge">recommended</span>
                    <div class="card-body p-5">
                        <h1 class="display-4">$129</h1>
                        <!-- <h6 class="text-body text-uppercase"> per month,<br> billed anually</h6> -->
                        <h2 class="mt-5 font-weight-normal mb-4">Multiple License</h2>
                        <p class="mb-4 px-md-4">you must purchase a Multiple-license for Only 5 project or client.</p>
                        <button class="btn btn-primary px-md-5">Get Started</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body p-5">
                        <h1 class="display-4">$499</h1>
                        <!-- <h6 class="text-body text-uppercase"> per month,<br> billed anually</h6> -->
                        <h2 class="mt-5 font-weight-normal mb-4">Extended License</h2>
                        <p class="mb-4 px-md-4">you must purchase a Multiple-license for Create Single SaSS based website.</p>
                        <button class="btn btn-outline-secondary px-md-5">Contact Us</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- [ Content ] end -->
<!-- [ Widget ] Start -->
<section class="widget d-none d-md-block">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div id="widget">
                <div class="w-imgs">
                    <div class="tilter">
                        <figure class="tilter__figure">
                            <img src="{{url('assets/images/landing/widgets/bg.png')}}" alt="images" />
                            <span class="ato_two tilter__caption">
                                    <img class="class-blur" src="{{url('assets/images/landing/widgets/w4.png')}}" alt="images" />
                                </span>
                            <span class="ato_one tilter__deco tilter__deco--lines">
                                    <img src="{{url('assets/images/landing/widgets/w5.png')}}" alt="images" />
                                    <img src="{{url('assets/images/landing/widgets/w6.png')}}" alt="images" />
                                    <img src="{{url('assets/images/landing/widgets/w1.png')}}" alt="images" />
                                    <span class="vc-row-wrap"> <img src="{{url('assets/images/landing/widgets/bg2.png')}}" alt="images" /> </span>
                                    <span class="vc-row-text"> <img src="{{url('assets/images/landing/widgets/w2.png')}}" alt="images" /> </span>
                                    <span class="vc-row-gallery"> <img src="{{url('assets/images/landing/widgets/w3.png')}}" alt="images" /> </span>
                                </span>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- [ Widget ] Start -->
<!-- [ Content ] start -->
<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-7 text-center text-md-left">
                <ul class="list-inline mb-5 ">
                    <li class="list-inline-item"><img src="assets/images/logo-dark.svg" alt="" class="logo hei-20"></li>
                    <li class="list-inline-item"><a class="text-body text-h-primary ml-2" href="#!">product</a></li>
                    <li class="list-inline-item"><a class="text-body text-h-primary ml-2" href="#!">features</a></li>
                    <li class="list-inline-item"><a class="text-body text-h-primary ml-2" href="#!">pricing</a></li>
                    <li class="list-inline-item"><a class="text-body text-h-primary ml-2" href="#!"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a class="text-body text-h-primary ml-2" href="#!"><i class="fab fa-instagram"></i></a></li>
                </ul>
                <p>© 2019 Treva, Inc. All rights reserved.</p>
                <p>Proudly Design by <a href="#!" class="text-primary">Tarful</a> & Built by <a href="#!" class="text-primary">Codedthemes</a>.</p>
            </div>
            <div class="col-md-5 text-center text-md-right">
                <a href="#!"><img src="assets/images/landing/img-apple-dnld.svg" alt="" class="img-fluid"></a>
                <a href="#!"><img src="assets/images/landing/img-google-dnld.svg" alt="" class="img-fluid"></a>
            </div>
        </div>
    </div>
</section>
@endsection

