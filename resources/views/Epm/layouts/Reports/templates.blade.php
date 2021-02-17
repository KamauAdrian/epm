<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Reports Templates</h1>
            {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
        </div>
        <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
            <a href="{{url('/adm/'.$auth_admin->id.'/create/new/report/template')}}">
{{--            <a href="{{url('/adm/'.$auth_admin->id.'/view/reports')}}">--}}
                <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        </div>
{{--        <div class="col-md-1"></div>--}}
        @if($templates)
            @foreach($templates as $template)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6>{{$template->name}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-6">
                                    <a href="{{url('/adm/'.$auth_admin->id.'/view/report/template/'.$template->id)}}">
                                        <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Template</p></button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#!">
{{--                                    <a href="{{url('/adm/'.$auth_admin->id.'/edit/report/template/'.$template->id)}}">--}}
                                        <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px;width: 150px;"><p class="align-self-center">Download <br>Template</p></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
{{--        <div class="col-md-1"></div>--}}
        <div class="col-sm-12">
            <a href="{{url('/adm/'.$auth_admin->id.'/create/new/report/template')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add New Template</a>
        </div>
    </div>
</div>
