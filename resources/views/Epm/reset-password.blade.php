@extends('Epm.layouts.login_register')
@section('form-text','Hi '.$admin_user->name.', Create a New Password For Your Account')
@section('form')
    <form method="post" action="{{url('/update/password',$admin_user->id)}}" class="my-5">
        @csrf
        <div class="form-group">
            <label>Create New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Create Password">
            <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
        <div class="form-group">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block mb-4">Reset Password</button>
        </div>
    </form>
@endsection
