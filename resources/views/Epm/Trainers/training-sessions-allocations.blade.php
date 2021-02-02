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
                @if($sessions)
                    @for($i=0;$i<count($sessions);$i++)
                        <?php
                        $sessions_all = [];
                        foreach ($sessions as $session){
                            $sessions_all[] = $session;
                        }
                        $Sessions_per_day_raw = $sessions_all[$i];
                        $sessions_per_day_array = [];
                        foreach ($sessions_all[$i] as $session_per_day){
                            $sessions_per_day_array[] = $session_per_day;
                        }
                        $sessions_per_day_new = array_slice($sessions_per_day_array,1);
//                        dd($sessions_all[0],array_slice($sessions_per_day_array,1));
                        ?>
                        @if($sessions_per_day_array)
                            <tr>
                                <td rowspan="{{count($sessions_per_day_array)}}">
                                    <?php $format_date = date('l dS M Y', strtotime($sessions_per_day_array[0]->date)); ?>
                                    {{$format_date}}
                                </td>
                                <td rowspan="{{count($sessions_per_day_array)}}">Health<br /> Break  5 <br /> minutes</td>
                                <td>{{$sessions_per_day_array[0]->start_time}} - {{$sessions_per_day_array[0]->end_time}}</td>
                                <td>{{$sessions_per_day_array[0]->name}}</td>
                                <td>Adrian</td>
                            </tr>
                            @foreach($sessions_per_day_new as $item)
                                <tr>
                                    <td>{{$item->start_time}} - {{$item->end_time}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <?php
                                        $trainers = $item->trainers;
                                        ?>
                                        @foreach($trainers as $trainer)
                                            {{$trainer->name}}<br />
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endfor
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
            $('#sessionsTableList').DataTable();
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
@endsection
