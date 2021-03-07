@extends('Epm.layouts.master')

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
                                        <div class="form-group" id="cmsLeaders">
                                            <label>Select Team Leaders</label>
                                            <multiselect v-model="selectedCms" :options="cms"
                                                         placeholder="Search" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true" multiple>
                                            </multiselect>
                                            <input type="hidden" v-for="cm in selectedCms" name="team_leaders[]" :value="cm.id">
                                            <span class="text-danger">{{$errors->first('team_leaders')}}</span>
                                        </div>
                                    </div>
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="form-group" id="cmsMembers">--}}
{{--                                            <label>Select Team Members</label>--}}
{{--                                            <multiselect name="cms" v-model="selectedCms" :options="cms"--}}
{{--                                                         placeholder="Search" label="name" track-by="id"--}}
{{--                                                         :searchable="true" :close-on-select="true" multiple>--}}
{{--                                            </multiselect>--}}
{{--                                            <input type="hidden" v-for="cm in selectedCms" name="team_members[]" :value="cm.id">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Create Team</button>
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
    <script>
        new Vue({
            el:"#cmsLeaders",
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedCms: null,
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
        });
        new Vue({
            el:"#cmsMembers",
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedCms: null,
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
        });
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection

