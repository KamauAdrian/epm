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
        <h5>Categories</h5>
    </div>
    <div class="card-body">
        <div class="col-md-12">
{{--            {{url("/adm/".$auth_admin->id."/view/training/".$training->id."/category/")}}--}}
            <a href="#!">
                    <div class="card training-day" style="color: grey;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Data Entry/Management</h5>
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
            <a href="#!">
                <div class="card training-day" style="color: grey;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Virtual Assistant</h5>
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
            <a href="#!">
                <div class="card training-day" style="color: grey;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Transcription</h5>
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
            <a href="#!">
                <div class="card training-day" style="color: grey;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Digital Marketing/Ecommerce</h5>
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
            <a href="#!">
                <div class="card training-day" style="color: grey;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h5>Content Writing and Translation</h5>
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
        </div>
    </div>
</div>
