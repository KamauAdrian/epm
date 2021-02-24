<?php
$auth_admin = auth()->user();
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="sessionsTable" class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Sessions</th>
                    <th>Date</th>
                    <th>Start At</th>
                    <th>Ends At</th>
                    <th>Institution</th>
                    <th>Town</th>
                    <th class="text-right">Status</th>
                </tr>
                </thead>
                @if($sessions!='')
                    <tbody>
                    @foreach($sessions as $session)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-body ml-3 align-self-center">
                                        <a href="{{url('/adm/'.$auth_admin->id.'/view/session',$session->id)}}">
                                            <h5 class="mb-1">{{$session->name}}</h5>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{$session->date}}
                            </td>

                            <td>
                                {{$session->start_date}}
                            </td>
                            <td>
                                {{$session->end_date}}
                            </td>
                            <td>
                                {{$session->institution}}
                            </td>
                            <td>
                                {{$session->location}}
                            </td>
                            @if($session->status=='Pending' && $auth_admin->role->name =='Su Admin' || $auth_admin->role->name == 'Project Manager')
                            <td class="text-right">
                                <div class="btn-group">
                                    <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                        <span class="badge badge-pill badge-light-dark">{{$session->status}}</span>
                                        <span class = "caret"></span>
                                    </button>
                                    <ul class = "dropdown-menu" role = "menu">
                                        <li><a href = "{{url('/view-session',$session->id)}}">View Session</a></li>
                                        <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$session->id)}}">Approve Session</a></li>
                                        <li><a href = "#!">Delete Session</a></li>
                                    </ul>
                                </div>
                            </td>
                            @else
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button type = "button" class = "btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="badge badge-pill badge-light-dark">{{$session->status}}</span>
                                            <span class = "caret"></span>
                                        </button>
                                        <ul class = "dropdown-menu" role = "menu">
                                            <li><a href ="{{url('/adm/view/session',$session->id)}}">View Session</a></li>
                                            <li><a href ="#!">Delete Session</a></li>
                                        </ul>
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

