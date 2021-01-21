@extends('Epm.layouts.login_register')
@section('form-text','Hi There, Please Enter Your Email Address To Reset Your Password')
@section('form')
    <form method="post" action="{{url('/request/reset/password')}}" class="my-5">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="Enter your Email Address">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block mb-4">Request New Password</button>
        </div>
    </form>
@endsection
