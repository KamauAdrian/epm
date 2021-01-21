@extends('layouts.adm-master')

@section('content')
<div class="auth-wrapper align-items-stretch bg-white">
    <div class="">
        <div class="auth-side-form">
            <div class="auth-content">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                            <div class="text-center">
                                    <img src="{{url('assets/images/epm-logo.jpeg')}}" alt="" class="img-fluid mb-5">
                                <h1 class="f-w-400">@yield('form-text')</h1>
                            </div>
                            @yield('form')
                                <div class="text-center">
                                    <h6 class="mb-0 text-muted">©2020 All Rights Reserved. emobilis®</h6>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="footer-cont text-center">--}}
{{--            <h6 class="mb-0 text-muted">©2020 All Rights Reserved. emmobilis®</h6>--}}
{{--        </div>--}}
{{--    </div>--}}
    @include('Epm.SuAdmins.ie-warning')
@endsection
