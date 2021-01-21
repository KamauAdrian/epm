@extends('Epm.layouts.master')
@section('styles')
{{--    <link rel="stylesheet" href="{{url('assets/css/bootstrap-select.min.css')}}">--}}
    <link rel="stylesheet" href="{{url('assets/css/multiselect.css')}}">
@endsection
@section('content')
    <!-- [ Dashboard ] start -->
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">@yield('form-desc')</h1>
                        </div>
                            @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Dashboard ] end -->

    <!-- datatable Js -->
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
{{--    <script src="{{url('assets/js/bootstrap-select.min.js')}}"></script>--}}
    <script src="{{url('assets/js/multiselect.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#clienttable').DataTable();
    </script>

    <script>
        $(document).ready(function() {
            $('.trainers').multiselect({
                nonSelectedText: 'Select Trainers',
            });
        });
    </script>
@endsection

