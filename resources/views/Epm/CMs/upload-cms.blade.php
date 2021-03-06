@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

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
                            <h1 class="f-w-400">Upload Center Managers</h1>
                        </div>
                        <form action="{{url('/adm/'.$auth_admin->id.'/upload/cms')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Select Center Managers Excel File</label>
                                        <input type="file" class="form-control" name="cms">
                                        <span class="text-danger">{{$errors->first('cms')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{url('/download/cms/excel/template')}}" class="text-success">
                                        Download Center Managers Excel Template
                                    </a>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Upload Center Managers" class="float-right btn btn-outline-info">
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
