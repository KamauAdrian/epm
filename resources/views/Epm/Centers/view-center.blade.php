@extends('Epm.layouts.master')

@section('content')

{{--    @include('Epm.layouts.center-view')--}}
@inject('centerDetails','App\Models\Center')
<?php
$auth_admin = auth()->user();
?>
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12 mb-4">
            <h1 class="d-inline-block font-weight-normal mb-0">{{$center->name}} Profile</h1>
            @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")
                <a href="{{url('/adm/'.$auth_admin->id.'/edit/center',$center->id)}}">
                    <button class="btn btn-outline-info float-right ml-2">Edit Center</button>
                </a>
            @endif
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-6">
            @if($center->image!=null)
                <img src="{{url('Centers/images/'.$center->image)}}" style="height: 250px; width: 100%" class="figure-img img-fluid rounded" alt="...">
            @else
                <img src="{{url('assets/images/center.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
            @endif
        </div>
        <div class="col-md-6">
            {{--            <h6><span class="text-small" style="font-size: 14px">Name:</span></h6>--}}
            {{--            <h3 class="d-inline-block font-weight-normal">{{$center->name}}</h3>--}}
            @if($center->description)
                <h6><span class="text-small" style="font-size: 14px">Center Description:</span></h6>
                <p style="font-size: 12px;">{{$center->description}}</p>
            @endif
            <h6><span class="text-small" style="font-size: 14px">County:</span></h6>
            <p style="font-size: 12px;">{{$center->county}}</p>
            <h6><span class="text-small" style="font-size: 14px">Town:</span></h6>
            <p class="mb-3" style="font-size: 12px;">{{$center->location}}</p>
        </div>
    </div>
    <div class="col-md-12 mt-4">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Center Managers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == "Su Admin" || $auth_admin->role->name == "Project Manager")
                    <a href="#!">
                        <button class="btn btn-outline-info float-right ml-2">Add Center Managers</button>
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $cms = $center->centerManagers;
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="cmsListTable" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                @if($cms!='')
                                    <tbody>
                                    @foreach($cms as $cm)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        {{--                                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/session',$session->id)}}">--}}
                                                        <h5 class="mb-1">{{$cm->name}}</h5>
                                                        {{--                                                        </a>--}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{$cm->email}}
                                            </td>
                                            <td>
                                                {{$cm->phone}}
                                            </td>
                                            <td>Actions</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
    <script>
        $(document).ready(function (){
            $("#cmsListTable").dataTable({
                "order":[],
            })
        });
    </script>
@endsection
