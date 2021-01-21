@extends('Epm.layouts.login_register')
@section('form-text','Hi '.$admin_user->name.', Please Create a Password To Activate Your Account')
@section('form')
    <form method="post" action="{{url('/update/account',$admin_user->id)}}" class="my-5">
        @csrf
        <div class="form-group">
            <label>Create Password</label>
            <input type="password" name="password" class="form-control" placeholder="Create Password">
            <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block mb-4">Activate Account</button>
        </div>
    </form>
@endsection
