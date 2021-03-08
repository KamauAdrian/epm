@extends('Epm.layouts.master')

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Center Managers Report Templates</h1>
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                <a href="{{url('/adm/'.$auth_admin->id.'/create/cms/report/template')}}">
                    <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i> Add New Template</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
            @if($reports)
                @foreach($reports as $report)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6>{{$report->name}}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row" >
                                    <div class="col-md-6">
                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/cms/report/template/'.$report->id)}}">
                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px; width: 150px;"><p class="align-self-center">View <br> Template</p></button>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#!">
                                            <button type="button" class="btn btn-sm btn-outline-info" style="font-size: 14px;width: 150px;"><p class="align-self-center">Download <br>Template</p></button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="col-sm-12">
                <a href="{{url('/adm/'.$auth_admin->id.'/create/cms/report/template')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add New Template</a>
            </div>
        </div>
    </div>
@endsection
