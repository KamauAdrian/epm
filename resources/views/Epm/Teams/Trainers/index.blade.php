@extends('Epm.SuAdmins.layouts.list')
@inject('teamTrainers', 'App\Models\TeamTrainer')

@section('styles')
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6 d-flex align-items-center mb-4">
                <h1 class="d-inline-block mb-0 font-weight-normal">Team Trainers</h1>
                {{--                <h6 class="d-inline-block mb-0 ml-4"><i class="feather icon-download"></i> Download list</h6>--}}
            </div>
            <div class="col-sm-6 d-block d-sm-flex align-items-center justify-content-end mb-4 text-right">
                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url("/adm/".$auth_admin->id."/create/team/trainers")}}">
                        <button type="button" class="mr-2 btn d-block ml-auto btn-outline-info"><i class="feather icon-plus mr-2"></i>Add Team Trainers</button>
                    </a>
                @endif
                <a href="#!">
                    <button type="button" class="ml-2 btn d-block ml-auto btn-outline-info">Export List</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

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
                                        $team_leaders_raw = $team->teamLeaders;
                                        $team_leaders = [];
                                        if (count($team_leaders_raw)<=2){
                                            foreach ($team_leaders_raw as $team_leader_raw){
                                                $names = $team->trainers()->find($team_leader_raw->team_leader_id)->name;
                                                $split_names = explode(" ",$names);
                                                if (count($split_names)>1){
                                                    $team_leaders[] = $split_names[0];
                                                }else{
                                                    $team_leaders[] = $names;
                                                }
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-body ml-3 align-self-center">
                                                        <h5 class="mb-1">{{$team->name}}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($team_leaders)
                                                        {{implode(",",$team_leaders)}}
                                                @else
                                                    {{count($team_leaders_raw)}} Team Leaders
                                                @endif
                                                @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                                                    <a href="{{url('adm/'.$auth_admin->id.'/add/team/trainer/members/team_id='.$team->id)}}">
                                                        <button type="button" title="Add Team Leaders" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                                                    </a>
                                                @endif
                                            </td>
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


            @if($auth_admin->role->name == 'Su Admin' || $auth_admin->role->name == 'Project Manager')
                    <a href="{{url('/add-team-trainers')}}" class="mb-0 text-body"><i class="feather icon-plus mr-2"></i>Add Team Trainers</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#teamTrainersList').DataTable({
                "order":[],
            });
        } );
    </script>
@endsection
