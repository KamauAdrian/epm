@extends('Epm.layouts.master')

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Upload Trainees to Session</h1>
                        </div>
                        <form action="{{url('/adm/'.$auth_admin->id.'/session/'.$session->id.'/save/uploaded/trainees')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Select Trainees Excel File</label>
                                        <input type="file" class="form-control" name="trainees">
                                        <span class="text-danger">{{$errors->first('trainees')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{url('/download/trainees/excel/template')}}" class="text-success">
                                        Download excel Template
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Upload" class="float-right btn btn-outline-info">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
