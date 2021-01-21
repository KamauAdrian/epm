@extends('Epm.layouts.master')
    <?php
        $auth_admin = auth()->user();
    ?>
@section('content')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Centers</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/center')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Center</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('Epm.layouts.centers-list')
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/center')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Center</a>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(function () {
            $(".deleteCenter").click(function () {
                var url = $(this).attr('data-url');
                console.log('this is the url'+ url);
                $("#deleteForm").attr("action", url);
            })
        });
    </script>
@endsection
