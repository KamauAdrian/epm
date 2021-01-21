<?php
$auth_admin = auth()->user();
?>
<div class="col-md-12">
    <center>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="text-success"><h5>{{session()->get('success')}}</h5></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </center>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Teams</th>
                    <th>Team Leader</th>
                    <th>Team Members</th>
                    <th class="text-right float-right">Actions</th>
                </tr>
                </thead>
                @if($teams)
                    <tbody>
                    @foreach($teams as $team)
                        <?php $id=$team->id; ?>
                        <?php $i=12; ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-body ml-3 align-self-center">
                                        <h5 class="mb-1">{{$team->name}}</h5>
                                    </div>
                                </div>
                            </td>
                            <td>{{$team->team_leader_name}}</td>
                            <td>
                                <?php
                                $members = count($teamCM->find($team->id)->centerManagers)
                                ?>
                                <p>
                                    @if($members==0)
                                        No Members Yet
                                    @elseif($members ==1)
                                        {{$members}} Member
                                    @else
                                        {{$members}} Members
                                    @endif
                                    @if(auth()->user()->role->name == 'Su Admin' || auth()->user()->role->name == 'Project Manager')
                                        <a href="{{url('/adm/'.$auth_admin->id.'/add/team/cms/members',$team->id)}}">
                                            <button type="button" title="Add Members" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                                        </a>
                                    @endif
                                </p>
                            </td>
                                <td class="text-right">
                                    @if(auth()->user()->role->name == 'Su Admin' || auth()->user()->role->name == 'Project Manager')
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
