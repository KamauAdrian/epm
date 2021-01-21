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
                    <button type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add @yield('button-text')</button>
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

{{--<div class="row">--}}
{{--    <div class="col-sm-6 d-flex align-items-center mb-4">--}}
{{--        <h1 class="d-inline-block mb-0 font-weight-normal">Project Managers</h1>--}}
{{--        <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
{{--    </div>--}}
{{--    <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">--}}
{{--        <a href="{{url('/adm-pm-add')}}">--}}
{{--            <button type="button" class="btn d-block ml-auto btn-primary"><i class="feather icon-plus mr-2"></i>Add</button>--}}
{{--        </a>--}}
{{--        <div class="btn-group btn-group-toggle btn-group-link">--}}
{{--            <label class="btn active">--}}
{{--                <input type="radio" name="options" id="filteropt11" checked=""> <i class="fas fa-sort-amount-down m-r-5"></i>SORT</label>--}}
{{--            <label class="btn ">--}}
{{--                <div class="dropdown mb-0 mr-2">--}}
{{--                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-sort-amount-up-alt m-r-5"></i>FILTER</a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right">--}}
{{--                        <a class="dropdown-item" href="#!"><i class="feather icon-alert-circle mr-2"></i> Priority</a>--}}
{{--                        <a class="dropdown-item" href="#!"><i class="feather icon-check mr-2"></i> Open Tasks</a>--}}
{{--                        <a class="dropdown-item" href="#!"><i class="feather icon-calendar mr-2"></i> Due Date</a>--}}
{{--                        <a class="dropdown-item" href="#!"><i class="feather icon-target mr-2"></i> Status</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <span class="my-2">|</span>--}}
{{--        <div class="btn-group btn-group-toggle btn-group-link">--}}
{{--            <label class="btn active">--}}
{{--                <input type="radio" name="options" id="listopt11" checked=""> <i class="fas fa-th-large"></i></label>--}}
{{--            <label class="btn ">--}}
{{--                <input type="radio" name="options" id="listopt12"> <i class="fas fa-list"></i></label>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
