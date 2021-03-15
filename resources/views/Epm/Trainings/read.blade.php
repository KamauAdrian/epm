@extends("Epm.Trainings.Layouts.training-master")

@section("trainingContent")
    <?php
    use App\Models\Center;use App\Models\Cohort;use App\Models\Institution;
    $auth_admin = auth()->user();
    $session_date = date_create($training->start_date);
    $split_date = date_format($session_date,'l dS M Y');
    $days = $training->trainingDays;
    $categories = $training->categories;
    ?>
        @if($training->training == "Virtual")
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Categories</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($categories as $category)
                                <a href="{{url("/adm/".$auth_admin->id."/view/training/".$training->id."/category/".$category->id)}}">
                                    {{--                                <a href="#!">--}}
                                    <div class="card training-day" style="color: grey;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>{{$category->name}}</h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Female)</h5>
                                                    12
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Male)</h5>
                                                    12
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Total)</h5>
                                                    24
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Trainees</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{url("/adm/".$auth_admin->id."/upload/training/".$training->id."/trainees")}}">
                                    <button type="button" class="btn btn-outline-info mt-3 disabled">Upload</button>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{url("/adm/".$auth_admin->id."/mark/training/".$training->id."/trainees/register")}}">
                                    <button type="button" class="btn btn-outline-info mt-3 disabled">Mark Register</button>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{url("/adm/".$auth_admin->id."/register/new/training/".$training->id."/trainee")}}">
                                    <button type="button" class="btn btn-outline-info mt-3 disabled">Add Trainee</button>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <table class=" table-bordered p-0">
                                    <thead>
                                        <tr>
                                            <th>Numbers <br /> Tabulation</th>
                                            <th>General</th>
                                            <th>Attended <br /> All</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><b>Male:</b></td>
                                        <td>{{count($training->trainees->where("gender","Male"))}}</td>{{--//general(overall training)--}}
                                        <td>10</td>{{--//attended all 5 days training)--}}
                                    </tr>
                                    <tr>
                                        <td><b>Female:</b></td>
                                        <td>{{count($training->trainees->where("gender","Female"))}}</td>{{--//general(overall training)--}}
                                        <td>10</td>{{--//attended all 5 days training)--}}
                                    </tr>
                                    <tr>
                                        <td><b>Total:</b></td>
                                        <td>{{count($training->trainees)}}</td>{{--//general(overall training)--}}
                                        <td>20</td>{{--//attended all 5 days training)--}}
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Days</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($days as $key=>$day)
                                <a href="{{url("/adm/".$auth_admin->id."/view/training/".$training->id."/day/".$day->id)}}">
                                    <div class="card training-day" style="color: grey;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h5>Day {{$day->day}}</h5>
                                                    {{date("dS M Y",strtotime($day->date))}}
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Female)</h5>
                                                    {{count($day->trainees->where("gender","Female"))}}
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Male)</h5>
                                                    {{count($day->trainees->where("gender","Male"))}}
                                                </div>
                                                <div class="col-md-3">
                                                    <h5>Trainees (Total)</h5>
                                                    {{count($day->trainees)}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
@endsection
