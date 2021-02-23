@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12" style="padding-left: 150px; padding-right: 150px">
                <div class="text-center">
                    <h1 class="f-w-400">Create A New Award</h1>
                </div>
                <?php
                $auth_admin = auth()->user();
                ?>

                <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/update/award/'.$award->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Award Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Best Performer" value="{{$award->name}}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" id="adminsList">
                                <label>Award Winner</label>
                                <multiselect v-model="selectedAdmin" :options="admins"
                                             placeholder="Search" label="name" track-by="id"
                                             :searchable="true" :close-on-select="true" multiple>
                                </multiselect>
                                <input type="hidden" v-for="winner in selectedAdmin" name="award_winners[]" :value="winner.id">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Award Description</label>
                                <textarea name="description" class="form-control" placeholder="A short Award Description" cols="30" rows="5">{{$award->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-outline-info btn-lg mb-3">Create Award</button>
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
