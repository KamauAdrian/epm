@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
                <div class="text-center">
                    <h1 class="f-w-400">Add A New Announcement</h1>
                </div>
                <?php
                $auth_admin = auth()->user();
                ?>

                <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/new/announcement')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Announcement Title" value="{{old('title')}}" required>
                                <span class="text-danger">{{$errors->first('title')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Announcement Link</label>
                                <input type="text" name="link" class="form-control" placeholder="Add A link To Announcement" value="{{old('link')}}" required>
                                <span class="text-danger">{{$errors->first('link')}}</span>
                            </div>
                        </div>
{{--                        <div class="col-sm-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Announcement Type</label>--}}
{{--                                div.form--}}
{{--                                <input type="file" name="image_video" class="form-control" required>--}}
{{--                                <span class="text-danger">{{$errors->first('link')}}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="image_video" class="form-control" required>
                                <span class="text-danger">{{$errors->first('link')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea name="description" class="form-control" placeholder="A short Announcement Description" cols="30" rows="5" required>{{old('description')}}</textarea>
                                <span class="text-danger">{{$errors->first('description')}}</span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-outline-info btn-lg mb-3">Add Announcement</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

@section('js')
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedAdmin: null,
                    admins: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/list/all/users')
                        .then(response => {
                            this.admins = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#adminsList')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
