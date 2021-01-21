@extends('Epm.layouts.form')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('sidebar-nav')
    @include('Epm.SuAdmins.layouts.sidebar-nav')
@endsection

@section('header-nav')
    @include('Epm.SuAdmins.layouts.header-nav')
@endsection

@section('form-desc','Add Trainer Team Member(s) for '.$team->name)

@section('form')
    @include('Epm.layouts.team-trainer-members-add')
@endsection
@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
{{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedTrainer: null,
                    trainers: [],
                }
            },
            mounted () {
                console.log('this is the team_id: '+this.$el.attributes.team_id.value)
                console.log('/trainers/new/'+this.$el.attributes.team_id.value)
                this.getCms()
                // this.getCms(this.cms)
            },
            methods:{
                getCms(){
                    axios
                        .get('/trainers/new/team/members/'+this.$el.attributes.team_id.value)
                        .then(response => {
                            this.trainers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                }
            },
        }).$mount('#trainers_new')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
