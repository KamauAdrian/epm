@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    $trainers = $trainingDay->trainers;
    $trainees = $trainingDay->trainees;
    $classes = $trainingDay->classes;
    ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                {{--                <h6><span class="text-small" style="font-size: 14px">Training:</span></h6>--}}
{{--                <h3 class="font-weight-normal">{{$trainingSession->name}}</h3>--}}
                {{--                <h6><span class="text-small" style="font-size: 14px">Session Date:</span></h6>--}}
{{--                <p>{{date('dS M Y',strtotime($trainingDay->day))}}</p>--}}
                {{--                <h6><Span class="text-small" style="font-size: 14px">Category:</Span></h6>--}}
{{--                <p style="font-size: 12px">{{$trainingSession->category}}</p>--}}
                {{--                <h6 class="text-small" style="font-size: 14px">Scheduled Time</h6>--}}
                {{--                <p style="font-size: 12px">Starts at {{$trainingSession->start_time}} and Ends at {{$trainingSession->end_time}}</p>--}}
            </div>
            <div class="col-md-4">
                <h6 class="text-small" style="font-size: 14px">Trainers</h6>
{{--                @foreach($trainers as $trainer)--}}
{{--                    <?php--}}
{{--                    $split_name = explode(' ',$trainer->name);--}}
{{--                    $avatar_icon_name = '';--}}
{{--                    if (count($split_name)>1){--}}
{{--                        $avatar_icon_name = $split_name[0];--}}
{{--                    }else{--}}
{{--                        $avatar_icon_name = $trainer->name;--}}
{{--                    }--}}
{{--                    ?>--}}
{{--                    <span class="badge badge-pill badge-success p-2">{{$avatar_icon_name}}</span>--}}
{{--                @endforeach--}}
                {{--        <a href="#!" title="Add New Trainer To This Session">--}}
{{--                <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/day/'.$trainingDay->id.'/add/trainers')}}" title="Add New Trainer To This Session">--}}
                <a href="#!" title="Add New Trainer To This Session">
                    <button type="button" class="btn btn-icon icon-s"><i class="feather icon-plus"></i></button>
                </a>
            </div>
            <div class="col-md-4">
                <h6 class="text-small" style="font-size: 14px">Classes/Cohorts</h6>
{{--                @foreach($classes as $class)--}}
{{--                    <?php--}}
{{--                    $split_name = explode(' ',$class->name);--}}
{{--                    $name = '';--}}
{{--                    if (count($split_name)>1){--}}
{{--                        $name = $split_name[0];--}}
{{--                    }else{--}}
{{--                        $name = $class->name;--}}
{{--                    }--}}
{{--                    ?>--}}
{{--                    <span class="badge badge-pill badge-success p-2">{{$name}}</span>--}}
{{--                @endforeach--}}
                {{--        <a href="#!" title="Add New Trainer To This Session">--}}
{{--                <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/day/'.$trainingDay->id.'/add/classes')}}" title="Add New Class To This Session">--}}
                <a href="#!" title="Add New Class To This Session">
                    <button type="button" class="btn btn-icon icon-s"><i class="feather icon-plus"></i></button>
                </a>
            </div>
        </div>
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
{{--                            <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/upload/trainees')}}" title="Upload Trainees Excel file">--}}
                            <a href="#!" title="Upload Trainees Excel file">
                                <button type="button" class="btn btn-lg btn-outline-info" style="font-size: 14px; width: 150px;">
                                    <span><i class="fa fa-upload"></i></span><br> <p class="align-self-center">Upload <br> Trainees</p>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
{{--                            <a href="{{url('/adm/'.$auth_admin->id.'/session/'.$trainingSession->id.'/add/trainees')}}" title="Add Trainee">--}}
                            <a href="#!" title="Add Trainee">
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
                <h6>Comments</h6>
            </div>
            <div class="card-body">
                <div class="media">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="#!" title="Upload Report">
                                <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                    <span><i class="fa fa-comment"></i></span><p class="align-self-center">Add <br> Comment</p>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#!" title="Upload Report">
                                <button type="button" class="btn btn-lg btn-outline-info align-self-center" style="font-size: 14px;width: 150px;">
                                    <span><i class="fa fa-book-open"></i></span><p class="align-self-center">View <br> Comments</p>
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
            <div class="card-header"><h6 class="text-small">Trainees</h6></div>
            <div class="card-body">
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
                        {{--                        @foreach($trainees as $trainee)--}}
                        {{--                            <tr>--}}
                        {{--                                <td>{{$trainee->name}}</td>--}}
                        {{--                                <td>{{$trainee->email}}</td>--}}
                        {{--                                <td>{{$trainee->phone_number}}</td>--}}
                        {{--                                <td>{{$trainee->gender}}</td>--}}
                        {{--                                <td>{{$trainee->category}}</td>--}}
                        {{--                                <td class="text-right">--}}
                        {{--                                    <div class="float-right">--}}
                        {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                        {{--                                            <span><i class="fa fa-envelope"></i></span>--}}
                        {{--                                        </a>--}}
                        {{--                                        <a href="#!" class="btn btn-sm btn-outline-info">--}}
                        {{--                                            <span><i class="fa fa-comment"></i></span>--}}
                        {{--                                        </a>--}}
                        {{--                                        <a href="#!" class="btn btn-sm btn-outline-danger">--}}
                        {{--                                            <span><i class="fa fa-trash"></i></span>--}}
                        {{--                                        </a>--}}
                        {{--                                    </div>--}}
                        {{--                                </td>--}}
                        {{--                            </tr>--}}
                        {{--                        @endforeach--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("js")
    <script>
        $('#traineesList').DataTable();
    </script>
@endsection
