@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    @inject('user','App\Models\User')
    <div class="col-sm-12">
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
                    <?php
                    $today = date('Y-m-d');
                    $tomorrow = date('Y-m-d',strtotime("+1 day",strtotime($today)));
                    $day_one_sessions = \App\Models\TrainingSession::where('date',$today)->get();
                    $day_two_sessions = \App\Models\TrainingSession::where('date',$tomorrow)->get();
                    $sessions_today = [];
                    $sessions_tomorrow = [];
                    foreach ($day_one_sessions as $day_one_session){
                        $sessions_today[]=$day_one_session;
                    }
                    //                dd($sessions_today[1]->trainers);
                    foreach ($day_two_sessions as $day_two_session){
                        $sessions_tomorrow[]=$day_two_session;
                    }
                    $new_sessions_today = array_slice($sessions_today,1);
                    $new_sessions_tomorrow = array_slice($sessions_tomorrow,1);
                    ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center">Training Sessions Allocation</th>
                    </tr>
                    <tr>
                        <th></th><th></th><th>Time</th><th>Session</th><th>Facilitators</th>
                    </tr>
                </thead>
                <tbody>
                @if($day_one_sessions)
                    <tr>
                        <td rowspan="{{count($sessions_today)}}">{{$today}}</td>
                        <td rowspan="{{count($sessions_today)}}">Health<br /> Break  5 <br /> minutes</td>
                        <td>{{$sessions_today[0]->start_time}} - {{$sessions_today[0]->end_time}}</td>
                        <td>{{$sessions_today[0]->name}}</td>
                        <td>
                            @foreach($sessions_today[0]->trainers as $trainer)
                                {{$trainer->name}}<br />
                            @endforeach
                        </td>
                    </tr>
                    @foreach($new_sessions_today as $new_session_today)
                        <tr>
                            <td>{{$new_session_today->start_time}} - {{$new_session_today->end_time}}</td>
                            <td>{{$new_session_today->name}}</td>
                            <?php
                            $trainers = $new_session_today->trainers;
                            ?>
                            <td>
                                @foreach($trainers as $trainer)
                                    {{$trainer->name}}<br />
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if($day_two_sessions)
                    <tr>
                        <td rowspan="{{count($sessions_tomorrow)}}">{{$tomorrow}}</td>
                        <td rowspan="{{count($sessions_tomorrow)}}">Health<br /> Break  5 <br /> minutes</td>
                        <td>{{$sessions_tomorrow[0]->start_time}} - {{$sessions_tomorrow[0]->end_time}}</td>
                        <td>{{$sessions_tomorrow[0]->name}}</td>
                        <td>
                            @foreach($sessions_tomorrow[0]->trainers as $trainer)
                                {{$trainer->name}}<br />
                            @endforeach
                        </td>
                    </tr>
                    @foreach($new_sessions_tomorrow as $new_session_tomorrow)
                        <tr>
                            <td>{{$new_session_tomorrow->start_time}} - {{$new_session_tomorrow->end_time}}</td>
                            <td>{{$new_session_tomorrow->name}}</td>
                            <?php
                            $trainers = $new_session_tomorrow->trainers;
                            ?>
                            <td>
                                @foreach($trainers as $trainer)
                                    {{$trainer->name}}<br />
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready( function () {
            $('#competenceTableList').DataTable();
        } );
    </script>
    <script type="text/javascript">
        $(function () {
            $(".deleteAdmin").click(function () {
                var url = $(this).attr('data-url');
                console.log('this is the url'+ url);
                $("#deleteAdminForm").attr("action", url);
            })
        });
    </script>
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>
    {{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1htWBhqk0WQmip2LhO3leVvRzUg3T-o&libraries=places"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
