@inject('session','App\Models\TrainingSession')
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
    <div class="col-md-4">
        <h6><span class="text-small" style="font-size: 14px">Session Name:</span></h6>
        <h3 class="font-weight-normal">{{$trainingSession->name}}</h3>
        <?php
        $session_date = date_create($trainingSession->date);
        $split_date = date_format($session_date,'l dS M Y');
        ?>
        <h6><span class="text-small" style="font-size: 14px">Session Date:</span></h6>
        <p>{{$split_date}}</p>
        <h6><Span class="text-small" style="font-size: 14px">Session Description:</Span></h6>
        <p style="font-size: 12px">{{$trainingSession->about}}</p>
        <h6 class="text-small" style="font-size: 14px">Scheduled Time</h6>
        <p style="font-size: 12px">Starts at {{$trainingSession->start_time}} and Ends at {{$trainingSession->end_time}}</p>
    </div>

    <div class="col-md-2">
        <h6><span class="text-small" style="font-size: 14px">Status</span></h6>
        @if($trainingSession->status == 'Approved')
            <p style="font-size: 12px"><span class="badge badge-pill badge-light-dark">{{$trainingSession->status}}</span></p>
        @elseif($trainingSession->status != 'Approved')
            <div class="btn-group">
                <button type = "button" class = "btn btn-outline-info dropdown-toggle mb-2" data-toggle="dropdown">
                    <span class="badge badge-pill badge-light-dark">{{$trainingSession->status}}</span>
                    <span class = "caret"></span>
                </button>
                @if($auth_admin->role->name == 'Su Admin')
                <ul class = "dropdown-menu" role = "menu">
                    <li><a href = "{{url('/adm/'.$auth_admin->id.'/confirm/session/session_id='.$trainingSession->id)}}">Approve Session</a></li>
{{--                    <li><a href = "#!">Delete Session</a></li>--}}
                </ul>
                @endif
            </div>
        @endif
        @if($trainingSession->type)
            <h6><span class="text-small" style="font-size: 14px">Session Type</span></h6>
            <p style="font-size: 12px">{{$trainingSession->type}}</p>
            @if($trainingSession->type == 'Public')
                <button type = "button" class = "btn btn-outline-info mb-2">
                    Click to Copy Session Invite Link
                </button>
            @endif
        @endif
    </div>

    <div class="col-md-6">
        <h6 class="text-small" style="font-size: 14px">Session Trainers</h6>
        <?php
        $trainers = $trainingSession->trainers;
//        dd($trainers);
        $trainees = $session::find($trainingSession->id)->trainees;
        ?>
        @foreach($trainers as $trainer)
            <?php
            $split_name = explode(' ',$trainer->name);
            $avatar_icon_name = '';
            if (count($split_name)>1){
                $avatar_icon_name = substr($split_name[0],0,1).substr(end($split_name),0,1);
            }else{
                $avatar_icon_name = substr($trainer->name,0,1);
            }
            ?>
        <span class="avtar text-blue-2 bg-blue-1 mr-3 mb-3" >{{$avatar_icon_name}}</span>
        @endforeach
{{--        <a href="#!" title="Add New Trainer To This Session">--}}
        <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/add/trainers')}}" title="Add New Trainer To This Session">
            <button type="button" class="btn btn-icon icon-lg"><i class="feather icon-plus"></i></button>
        </a>
    </div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h6>Trainees</h6>
        </div>
        <div class="card-body">
            <div class="media">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/upload/trainees')}}" title="Upload Trainees Excel file">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                <span><i class="fa fa-upload"></i></span><br> <p class="align-self-center">Upload <br> Trainees</p>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/add/trainees')}}" title="Add Trainee">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                <span><i class="fa fa-plus"></i></span> <br> <p class="align-self-center">Add <br>Trainee</p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h6>Communication</h6>
        </div>
        <div class="card-body">
            <div class="media">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#!" title="Email All Trainees">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px;width: 150px;">
                                <span><i class="fa fa-envelope"></i></span> <br> <p class="align-self-center">Email <br> Trainees</p>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#!" title="SMS All Trainees">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                <span><i class="fa fa-comment"></i></span> <br> <p class="align-self-center">SMS <br>Trainees</p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h6>Progress</h6>
        </div>
        <div class="card-body">
            <div class="media">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#!" title="Upload Photos">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;width: 150px;">
                                <span><i class="fa fa-image"></i></span> <br> <p class="align-self-center">Upload <br> Images</p>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#!" title="Impact Stories">
                            <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                <span><i class="fa fa-pencil-alt"></i></span><p class="align-self-center">Impact <br> Stories </p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h6>Reports</h6>
        </div>
        <div class="card-body">
            <div class="media">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#!" title="Upload Report">
                            <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                <span><i class="fa fa-download"></i></span><p class="align-self-center">Download <br> Template</p>
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#!" title="Upload Report">
                            <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                <span><i class="fa fa-book-open"></i></span><p class="align-self-center">Submit <br> Report</p>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h6 class="text-small">Trainees on the Session</h6>
            <div class="table-responsive">
                <table id="traineesList" class="table table-center mb-0 ">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Category</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($trainees as $trainee)
                    <tr>
                        <td>{{$trainee->name}}</td>
                        <td>{{$trainee->email}}</td>
                        <td>{{$trainee->phone_number}}</td>
                        <td>{{$trainee->gender}}</td>
                        <td>{{$trainee->category}}</td>
                        <td class="text-right">
                            <div class="float-right">
                                <a href="#!" class="btn btn-sm btn-outline-info">
                                    <span><i class="fa fa-envelope"></i></span>
                                </a>
                                <a href="#!" class="btn btn-sm btn-outline-info">
                                    <span><i class="fa fa-comment"></i></span>
                                </a>
                                <a href="#!" class="btn btn-sm btn-outline-danger">
                                   <span><i class="fa fa-trash"></i></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

