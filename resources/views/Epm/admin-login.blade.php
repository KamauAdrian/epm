@extends('Epm.layouts.login_register')
@section('form-text','Hi there, please log in')
@section('form')
<form method="post" action="{{url('/auth-login')}}" class="my-5">
    @if(session()->has('error'))
        <div class="form-group alert alert-danger alert-dismissible fade show" role="alert">
            <span class="text-danger">{{session()->get('error')}}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session()->has('success'))
        <div class="form-group alert alert-success alert-dismissible fade show" role="alert">
            <span class="text-success">{{session()->get('success')}}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @csrf
    <div class="form-group">
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Ex. luke@jacademy.org" value="{{old('email')}}">
        <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-info btn-block mb-4">Log in</button>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="chklog1">
                    <label class="custom-control-label" for="chklog1">Remember me</label>
                </div>
            </div>
            <div class="col text-right">
                <a href="{{url('/forgot/password')}}" style="color: #7E858E;">Forgot Password?</a>
            </div>
        </div>
    </div>
</form>
@endsection
