@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Announcements</h1>
            </div>
            <div class="col-md-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/new/announcement')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info">Add Announcement</button>
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="AnnouncementsListTable" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Announcements</th>
                                    <th>Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                @if($announcements!='')
                                    <tbody>
                                    @foreach($announcements as $announcement)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <a target="_blank" href="{{$announcement->link}}">
                                                            <h5 class="mb-1">{{$announcement->title}}</h5>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>
                                                    {{date('l dS M Y',strtotime($announcement->created_at))}}
                                                </p>
                                            </td>
                                            @if($auth_admin->role->name != 'Su Admin')
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a target="_blank" href="{{url($announcement->link)}}" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-right">
                                                    <div class="float-right">
                                                        <a target="_blank" href="{{url($announcement->link)}}" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/edit/announcement/'.$announcement->id)}}" class="btn btn-sm btn-outline-info" title="Edit">
                                                            <span><i class="fa fa-pencil-alt"></i></span>
                                                        </a>
                                                        <div  data-url="{{url('/adm/'.$auth_admin->id.'/delete/announcement/'.$announcement->id)}}" class="btn btn-sm btn-outline-danger deleteAdmin" data-toggle="modal"  title="Delete">
                                                            <span><i class="fa fa-trash"></i></span>
                                                        </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                @if($auth_admin->role->name == 'Su Admin')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/new/announcement')}}" class="mb-0 text-body">Add Announcement</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        $(document).ready(function (){
            $("#AnnouncementsListTable").dataTable({
                "order":[],
            });
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
