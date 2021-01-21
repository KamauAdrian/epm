<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Clubs</th>
                    <th>Club Leader</th>
                    <th>Club Members</th>
                    <th class="text-right float-right">Actions</th>
                    <th></th>
                </tr>
                </thead>
{{--                @if($teams)--}}
{{--                    <tbody>--}}
{{--                    @foreach($teams as $team)--}}
{{--                        <?php $id=$team->id; ?>--}}
{{--                        <?php $i=12; ?>--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <div class="media">--}}
{{--                                    <div class="media-body ml-3 align-self-center">--}}
{{--                                        <h5 class="mb-1">{{$team->name}}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>{{$team->team_leader_name}}</td>--}}
{{--                            <td>--}}
{{--                                <p>--}}
{{--                                    {{count($teamCM->find($team->id)->centerManagers)}} Members--}}
{{--                                    <a href="{{url('/add-team-cms-members',$team->id)}}">--}}
{{--                                        <button type="button" title="Add Members" class="btn btn-icon"><i class="feather icon-plus"></i></button>--}}
{{--                                    </a>--}}
{{--                                </p>--}}
{{--                            </td>--}}
{{--                            <td class="text-right">--}}
{{--                                <div class="float-right">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-3"><a href="{{url('/adm-view-pm-profile')}}" title="View"><span><i class="fa fa-list"></i></span></a></div>--}}
{{--                                        <div class="col-sm-3"><a href="{{url('/adm-edit-pm-profile')}}" title="Edit"><span><i class="fa fa-pencil-alt"></i></span></a></div>--}}
{{--                                        <div class="col-sm-3"><a href="{{url('/adm-delete-pm')}}" title="Delete"><span><i class="fa fa-trash"></i></span></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                @endif--}}
            </table>
        </div>
    </div>
</div>
