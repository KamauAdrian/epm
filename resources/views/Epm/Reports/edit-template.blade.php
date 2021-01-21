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
                            <h1 class="f-w-400">Edit {{$template->name}}</h1>
                        </div>
                        @include('Epm.layouts.Reports.edit-template')
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
        $(document).on("click", "#addNewQuestion", function(){
            var question = $('.addReportQuestion');
            question.last().after('<div class="col-sm-12 addReportQuestion">'+question.first().html()+'</div><br />');
        });

        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedGroup: this.getSavedActors(),
                    admins: [
                        'Center Manager','Project Manager', 'Su Admin'
                    ],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/actors')
                        .then(response => {
                            this.admins = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
                getSavedActors(){
                  return document.getElementById('saved_target_group').value
                },
            },
        }).$mount('#key_actors')

        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedInfo: null,
                    infos: [
                        'Name','Employee Number','Date of Report','Role','Duty Station'
                    ],
                }
            },
            methods:{

            },
        }).$mount('#report_user_info')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
