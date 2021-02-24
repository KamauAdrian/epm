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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Announcement Type</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 ml-4">
                                    <div class="form-group">
                                        <input type="radio" name="type" onclick="showVideoInputLink()" value="Video"> Video
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="type" onclick="showImageInputUpload()" value="Image"> Image
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="text-danger">{{$errors->first('type')}}</span>
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
                        <div class="col-sm-12" style="display: none" id="announcement_img_upload">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12" style="display: none" id="announcement_video_link">
                            <div class="form-group">
                                <label>Announcement Video Link</label>
                                <input type="text" name="video_link" class="form-control" placeholder="Paste Video Link Here">
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
        var video = $("#announcement_video_link");
        var image = $("#announcement_img_upload");
        function showVideoInputLink(){
            document.getElementById('announcement_video_link').style.display="block";
            document.getElementById('announcement_img_upload').style.display="none";
            console.log(document.getElementById('announcement_img_upload').value);
            // video.attr("style","display=block");
        }
        function showImageInputUpload(){
            document.getElementById('announcement_video_link').style.display="none";
            document.getElementById('announcement_img_upload').style.display="block";
            // video.attr("style","display=none");
            // image.attr("style","display=block");
        }
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
