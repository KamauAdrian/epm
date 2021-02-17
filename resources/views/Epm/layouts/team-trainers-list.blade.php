<?php
$auth_admin = auth()->user();
?>
<div class="col-md-12">
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="teamTrainersList" class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Teams</th>
                    <th>Team Leaders</th>
                    <th>Members</th>
                    <th class="text-right">Actions</th>
                </tr>
                </thead>
                @if($teams)
                    <tbody>
                    @foreach($teams as $team)
                        <?php
                        $team_leaders = \App\Models\TeamTrainer::find($team->id)->teamLeaders;
                        ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-body ml-3 align-self-center">
                                        <h5 class="mb-1">{{$team->name}}</h5>
                                    </div>
                                </div>
                            </td>
                            <td>{{$team->team_leader_name}}</td>
{{--                            @if($team_leaders)--}}
{{--                                <td>--}}
{{--                                    @foreach($team_leaders as $team_leader)--}}
{{--                                        {{$team_leader->name}}--}}
{{--                                    @endforeach--}}
{{--                                </td>--}}
{{--                            @endif--}}
                            <?php
                            $members = count($teamTrainers->find($team->id)->trainers)
//                            dd(count($teamTrainers::find($team->id)->trainers));
                            ?>
                            <td>
                                <p>
                                    @if($members==0)
                                    No Members Yet
                                    @elseif($members ==1)
                                        {{$members}} Member
                                    @else
                                        {{$members}} Members
                                    @endif
                                    @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                        <a href="{{url('adm/'.$auth_admin->id.'/add/team/trainer/members/team_id='.$team->id)}}">
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
