@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    {{--    @include('Epm.layouts.Reports.templates')--}}
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <center>
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="text-success"><h5>{{session()->get('success')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <span class="text-danger"><h5>{{session()->get('error')}}</h5></span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </center>
            </div>
        </div>
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Add New PMO Performance Appraisal</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/add/pmo/performance/appraisal')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" id="pmos">
                                        <label>Select PMO</label>
                                        <multiselect :options="pmos" v-model="selectedPmo"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true"
                                                     >
                                        </multiselect>
                                        <input type="hidden" name="pmo_id" v-for="pmo in selectedPmo"  :value="selectedPmo.id">
                                        <input type="hidden" name="pmo" v-for="pmo in selectedPmo"  :value="selectedPmo.name">
                                        <input type="hidden" name="pmo_email" v-for="pmo in selectedPmo"  :value="selectedPmo.email">
                                        <span class="text-danger">{{$errors->first('pmo')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="supervisor">
                                        <label>Select Supervisor</label>
                                        <multiselect :options="supervisors" v-model="selectedSupervisor"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true"
                                                     multiple>
                                        </multiselect>
                                        <input type="hidden" name="supervisor_ids[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.id">
                                        <input type="hidden" name="supervisor_names[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.name">
                                        <input type="hidden" name="supervisor_emails[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.email">
                                        <span class="text-danger">{{$errors->first('supervisor_ids')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Create Appraisal</button>
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
    <script type="text/javascript">
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedPmo: null,
                    pmos: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/pmos')
                        .then(response => {
                            this.pmos = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#pmos')
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedSupervisor: null,
                    supervisors: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/pmos')
                        .then(response => {
                            this.supervisors = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#supervisor')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
