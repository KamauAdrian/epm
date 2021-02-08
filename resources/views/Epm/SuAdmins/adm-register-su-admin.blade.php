@extends('Epm.layouts.master')

@section('content')
    <!-- [ Dashboard ] start -->
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                            <div class="text-center">
                                <h1 class="f-w-400">Create Super User Admin</h1>
                            </div>
                            <form method="post" action="{{url('/save/su-admin')}}" class="my-5">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>full name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                                            <span class="text-danger">{{$errors->first('name')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" name="email" class="form-control" placeholder="Ex. luke@jacademy.org" value="{{old('email')}}">
                                            <span class="text-danger">{{$errors->first('email')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone" class="form-control" placeholder="0728909090" value="{{old('phone')}}">
                                            <span class="text-danger">{{$errors->first('phone')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input name="password" type="password" class="form-control">
                                            <span class="text-danger">{{$errors->first('password')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Repeat Password</label>
                                            <input name="password_confirmation" type="password" class="form-control">
                                            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-between">
                                        <div class="col-auto">
                                            <p><small>By signing up, I agree to the Privacy Policy and Terms of Service.</small></p>
                                        </div>
                                        <div class="col-auto text-right">
                                            <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Dashboard ] end -->

    <!-- datatable Js -->
    <script src="{{url('assets/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $('#clienttable').DataTable();
    </script>
@endsection
