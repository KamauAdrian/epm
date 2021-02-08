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
                            <h1 class="f-w-400">Add Center Manager Team Members for {{$team->name}}</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/team/cms/members/team_id='.$team->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div team_id="{{$team->id}}" class="form-group" id="cms_new">
                                        {{--            <div class="form-group" id="cms">--}}
                                        <label>Select Team Members</label>
                                        <testkit v-model="selectedCm" :options="cms"
                                                 placeholder="Search" label="name" track-by="id"
                                                 :searchable="false" :close-on-select="true" multiple>
                                        </testkit>
                                        <input type="hidden" v-for="member in selectedCm" name="cm_team_member_s_id[]" :value="member.id">
                                        <span class="text-danger">{{$errors->first('cm_team_member_s_id')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row justify-content-between">
                                    <div class="col-auto text-right">
                                        <button type="submit" class="btn btn-primary btn-block mb-3">Add Members</button>
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
                testkit: window.VueMultiselect.default,
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
                        .get('/cms/new/'+this.$el.attributes.team_id.value)
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
        }).$mount('#cms_new')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
