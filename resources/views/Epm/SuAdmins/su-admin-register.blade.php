@extends('Epm.layouts.login_register')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('form-text','Get Started With Your Account')

@section('form')
    <form method="post" action="{{url('/su-admin-save')}}" class="my-5">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>full name</label>
                    <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group" id="gender">
                    <label>Gender</label>
                    <gender name="gender" v-model="selectedGender" :options="gender"
                            placeholder="Select Gender"
                            :searchable="true" :close-on-select="true">
                    </gender>
                    <input type="hidden" name="gender" :value="selectedGender">
                    <span class="text-danger">{{$errors->first('gender')}}</span>
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
                    <p><small>By signing up, I agree to the Treva Privacy Policy and Terms of Service.</small></p>
                </div>
                <div class="col-auto text-right">
                    <button type="submit" class="btn btn-primary btn-block mb-3">Sign up</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                gender: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedGender: null,
                    gender: [
                        'Male','Female',
                    ],
                }
            },
            methods:{
            },
        }).$mount('#gender')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
