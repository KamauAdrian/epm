@section('styles')
    <style>
        .card .training-day :hover{
            background-color: lightgray;
        }
    </style>
@endsection
<?php
$auth_admin = auth()->user();
?>
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


