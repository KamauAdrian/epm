@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Create a New Team For Center Managers</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/team/cms')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Team Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>
                                </div>
                                @if($cms!='')
                                    <div class="col-sm-12">
                                        <div class="form-group" id="cms">
                                            <label>Select Team Leaders</label>
                                            <multiselect name="cms" v-model="selectedCm" :options="cms"
                                                         placeholder="Search" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true" multiple>
                                            </multiselect>
                                            <input type="hidden" v-for="cm in selectedCm" name="team_leader_ids[]" :value="cm.id">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Team Description</label>
                                        <textarea name="about" class="form-control" placeholder="Short Team Description" cols="30" rows="5"></textarea>
                                        <span class="text-danger">{{$errors->first('about')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Create Team</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedCm: null,
                    cms: [],
                }
            },
            mounted () {
                this.getCms()
            },
            methods:{
                getCms(){
                    axios
                        .get('/cms')
                        .then(response => {
                            this.cms = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                }
            },
        }).$mount('#cms')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection

