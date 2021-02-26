@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1 class="d-inline-block mb-0 font-weight-normal text-center">Accept Employee Leave</h1>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?php
        $auth_admin = auth()->user();
        $applicant = $application->owner;
        ?>
        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/accept/employee/leave/'.$application->id)}}">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" value="{{$applicant->name}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employee Email Address</label>
                        <input type="text" value="{{$applicant->email}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employee Phone</label>
                        <input type="text" value="{{$applicant->phone}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employee Employee Number</label>
                        <input type="text" value="{{$applicant->employee_number}}" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Reason</label>
                        <textarea name="reason" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Accept Leave</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
