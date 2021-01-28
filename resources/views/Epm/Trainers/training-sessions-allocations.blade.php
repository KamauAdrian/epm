@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
{{--                <div class="text-center">--}}
{{--                    <h1 class="f-w-400">Training Sessions Allocation</h1>--}}
{{--                </div>--}}
                <?php
                $day_one = date('Y-m-d');
                $day_two = date('Y-m-d',strtotime("+1 day",strtotime($day_one)));
                $sessions = \App\Models\TrainingSession::where('date',$day_one)->get();
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center">Training Sessions Allocation</th>
                            </tr>
                            <tr>
                                <th></th><th></th><th>Time</th><th>Session</th><th>Facilitator</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($sessions)
                            @foreach($sessions as $session)
                                <tr>
                                    <td rowspan="{{count($sessions)}}">{{$day_one}}</td>
                                    <td rowspan="{{count($sessions)}}">Health<br /> Break  5 <br /> minutes</td>
                                    <td>{{$session->start_time}}</td>
                                    <td>{{$session->name}}</td>
                                    <td>Valentine Njeri</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
{{--                @include('Epm.layouts.trainer-add')--}}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9yYsUxZxbbnwhBcyRnWhorWhNPuQYPus&libraries=places&callback=activatePlacesSearch"></script>
    {{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1htWBhqk0WQmip2LhO3leVvRzUg3T-o&libraries=places"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
