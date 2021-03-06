@extends('Epm.layouts.master')

<?php
$auth_admin = auth()->user();
?>
@section('content')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Team Center Managers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/team/cms')}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Team Center Managers</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-md-12">
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="teamCmsList" class="table table-center mb-0 ">
                                <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>Team Leaders</th>
                                    <th>Team Members</th>
                                    <th class="text-right float-right">Actions</th>
                                </tr>
                                </thead>
                                @if($teams)
                                    <tbody>
                                    @foreach($teams as $team)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$team->name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                            Team leaders
                                            </td>
                                            <td>
                                                <?php
                                                $members = count($team->centerManagers)
                                                ?>
                                                <p>
                                                    @if($members==0)
                                                        No Members Yet
                                                    @elseif($members ==1)
                                                        {{$members}} Member
                                                    @else
                                                        {{$members}} Members
                                                    @endif
                                                    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                        <a href="{{url('/adm/'.$auth_admin->id.'/add/team/cms/members/team_id='.$team->id)}}">
                                                            <button type="button" title="Add Members" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                                                        </a>
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="text-right">
                                                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="Edit">
                                                            <span><i class="fa fa-pencil-alt"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View Reports">
                                                            <span><i class="fa fa-book-open"></i></span>
                                                        </a>
                                                        <a href="#!" class="btn btn-sm btn-outline-danger" title="Delete">
                                                            <span><i class="fa fa-trash"></i></span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="float-right">
                                                        <a href="#!" class="btn btn-sm btn-outline-info" title="View">
                                                            <span><i class="fa fa-list"></i></span>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>


                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/adm/'.$auth_admin->id.'/add/team/cms')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Team Center Managers</a>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready( function () {
            $('#teamCmsList').DataTable({
                "order":[],
            });
        } );
    </script>
@endsection
