@extends('Epm.layouts.master')

@section('content')
    <!-- [ Dashboard ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">@yield('page-title')</h1>
{{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                <a href="/@yield('add-url')">
                    <button type="button" class="btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add @yield('button-text')</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @yield('content-list')
                <a href="/@yield('add-url')" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add @yield('button-text')</a>
            </div>
        </div>
    </div>
    <!-- [ Dashboard ] end -->
@endsection
@section('js')
    <!-- datatable Js -->
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#clienttable').DataTable();
    </script>
@endsection
